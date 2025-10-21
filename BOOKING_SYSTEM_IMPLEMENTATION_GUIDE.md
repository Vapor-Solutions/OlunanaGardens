# Booking System Implementation Guide

## 🎯 Quick Start

### Step 1: Run the Migrations
```bash
php artisan migrate
```

This will create/modify:
- `bookings` table (add new columns)
- `booking_requests` table (add new columns)
- `booking_section` pivot table (add new columns)
- `payments` table (add new columns)
- **NEW** `booking_status_histories` table

### Step 2: Service Registration (Optional but Recommended)

Create a service provider to auto-resolve services:

```bash
php artisan make:provider BookingServiceProvider
```

Update `app/Providers/BookingServiceProvider.php`:

```php
<?php

namespace App\Providers;

use App\Services\AvailabilityChecker;
use App\Services\BookingService;
use App\Services\BookingStatusManager;
use Illuminate\Support\ServiceProvider;

class BookingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AvailabilityChecker::class);
        $this->app->singleton(BookingStatusManager::class);
        $this->app->singleton(BookingService::class);
    }

    public function boot(): void
    {
        // Boot logic if needed
    }
}
```

Add to `config/app.php` in `providers` array:
```php
App\Providers\BookingServiceProvider::class,
```

### Step 3: Update Existing Components

#### Update Admin Bookings Create Component
File: `app/Livewire/Admin/Bookings/Create.php`

```php
<?php

namespace App\Livewire\Admin\Bookings;

use App\Models\Booking;
use App\Models\Client;
use App\Models\EventType;
use App\Models\Package;
use App\Models\Section;
use App\Services\AvailabilityChecker;
use App\Services\BookingService;
use Livewire\Component;

class Create extends Component
{
    public BookingService $bookingService;
    public AvailabilityChecker $availabilityChecker;

    // Form properties
    public $client_id = '';
    public $event_type_id = '';
    public $package_id = '';
    public $start_time = '';
    public $end_time = '';
    public $capacity_adults = 1;
    public $capacity_children = 0;
    public $price = '';
    public $notes = '';
    public $section_ids = [];

    // UI properties
    public $availableSections = [];
    public $bookingClients = [];
    public $bookingEventTypes = [];
    public $bookingPackages = [];

    #[Computed]
    public function totalCost()
    {
        if (!$this->price) {
            return 0;
        }

        return ($this->capacity_adults * $this->price) +
               ($this->capacity_children * $this->price * 0.5);
    }

    public function mount(): void
    {
        $this->bookingService = app(BookingService::class);
        $this->availabilityChecker = app(AvailabilityChecker::class);
        $this->loadSelects();
    }

    public function loadSelects(): void
    {
        $this->bookingClients = Client::orderBy('name')->get();
        $this->bookingEventTypes = EventType::orderBy('title')->get();
        $this->bookingPackages = Package::orderBy('title')->get();
    }

    #[On('update:start_time')]
    #[On('update:end_time')]
    public function updateAvailableSections(): void
    {
        if (!$this->start_time || !$this->end_time) {
            $this->availableSections = [];
            return;
        }

        try {
            $availability = $this->availabilityChecker->getAvailabilityStatus(
                $this->start_time,
                $this->end_time
            );
            $this->availableSections = $availability['available'];
        } catch (\Exception $e) {
            $this->addError('start_time', $e->getMessage());
            $this->availableSections = [];
        }
    }

    public function createBooking(): void
    {
        $this->validate([
            'client_id' => 'required|exists:clients,id',
            'event_type_id' => 'required|exists:event_types,id',
            'start_time' => 'required|date_format:Y-m-d H:i',
            'end_time' => 'required|date_format:Y-m-d H:i|after:start_time',
            'capacity_adults' => 'required|integer|min:0',
            'capacity_children' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            $booking = $this->bookingService->createBooking([
                'client_id' => $this->client_id,
                'event_type_id' => $this->event_type_id,
                'package_id' => $this->package_id ?: null,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'capacity_adults' => $this->capacity_adults,
                'capacity_children' => $this->capacity_children,
                'price' => $this->price,
                'notes' => $this->notes,
            ], $this->section_ids);

            session()->flash('message', "Booking created successfully! Ref: {$booking->booking_ref}");
            $this->redirect(route('admin.bookings.edit', $booking));
        } catch (\Exception $e) {
            $this->addError('general', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.bookings.create');
    }
}
```

#### Update Admin Bookings Edit Component
Similar changes to `Edit.php` - use `updateSections()` method

### Step 4: Create New Booking Approval Component

Create: `app/Livewire/Admin/BookingRequests/Approve.php`

```php
<?php

namespace App\Livewire\Admin\BookingRequests;

use App\Models\BookingRequest;
use App\Models\Section;
use App\Services\BookingService;
use Livewire\Component;

class Approve extends Component
{
    public BookingRequest $request;
    public BookingService $bookingService;

    public $section_ids = [];
    public $admin_notes = '';
    public $availableSections = [];
    public $shouldConfirm = false;

    public function mount(BookingRequest $request): void
    {
        $this->request = $request;
        $this->bookingService = app(BookingService::class);
        $this->loadAvailableSections();
    }

    public function loadAvailableSections(): void
    {
        $checker = app(\App\Services\AvailabilityChecker::class);
        $this->availableSections = $checker->getAvailableS ections(
            $this->request->start_time,
            $this->request->end_time
        );
    }

    public function approve(): void
    {
        $this->validate([
            'section_ids' => 'required|array|min:1',
            'section_ids.*' => 'exists:sections,id',
        ]);

        try {
            $booking = $this->bookingService->convertRequestToBooking(
                $this->request,
                $this->section_ids,
                $this->admin_notes
            );

            session()->flash('success', "Request approved! Booking created: {$booking->booking_ref}");
            $this->redirect(route('admin.booking-requests'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function reject(): void
    {
        $this->validate([
            'admin_notes' => 'required|string|min:5',
        ]);

        $this->request->markAsRejected(
            $this->admin_notes,
            $this->admin_notes
        );

        session()->flash('warning', 'Request rejected');
        $this->redirect(route('admin.booking-requests'));
    }

    public function render()
    {
        return view('livewire.admin.booking-requests.approve');
    }
}
```

### Step 5: Test the System

Create test file: `tests/Unit/Services/BookingServiceTest.php`

```php
<?php

namespace Tests\Unit\Services;

use App\Models\Booking;
use App\Models\BookingRequest;
use App\Models\Client;
use App\Models\EventType;
use App\Models\Section;
use App\Services\AvailabilityChecker;
use App\Services\BookingService;
use App\Services\BookingStatusManager;
use PHPUnit\Framework\TestCase;

class BookingServiceTest extends TestCase
{
    protected BookingService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new BookingService(
            new AvailabilityChecker(),
            new BookingStatusManager()
        );
    }

    public function test_can_create_booking(): void
    {
        $client = Client::factory()->create();
        $eventType = EventType::factory()->create();

        $booking = $this->service->createBooking([
            'client_id' => $client->id,
            'event_type_id' => $eventType->id,
            'start_time' => now()->addDay(),
            'end_time' => now()->addDay()->addHours(4),
            'capacity_adults' => 50,
            'capacity_children' => 10,
            'price' => 100,
        ]);

        $this->assertNotNull($booking->booking_ref);
        $this->assertEquals(Booking::STATUS_PENDING, $booking->status);
    }

    public function test_prevents_double_booking(): void
    {
        $section = Section::factory()->create();
        $booking = Booking::factory()->create();
        $booking->sections()->attach($section->id);

        $this->expectException(Exception::class);

        $this->service->createBooking([
            'client_id' => Client::factory()->create()->id,
            'event_type_id' => EventType::factory()->create()->id,
            'start_time' => $booking->start_time,
            'end_time' => $booking->end_time,
            'capacity_adults' => 10,
            'capacity_children' => 0,
            'price' => 100,
        ], [$section->id]);
    }
}
```

---

## 🔄 Status Workflow Examples

### Example 1: Customer Request → Booking

```php
// 1. Customer submits form (creates BookingRequest)
$request = BookingRequest::create([
    'client_id' => $clientId,
    'event_type_id' => $eventTypeId,
    'start_time' => $startTime,
    'end_time' => $endTime,
    'capacity_adults' => 50,
    'capacity_children' => 20,
    'special_requests' => 'Need VIP treatment',
]);

// 2. Admin reviews in Booking Requests list
// 3. Admin approves and converts
$booking = $bookingService->convertRequestToBooking(
    $request,
    [1, 2, 3], // section IDs
    'Approved and scheduled'
);
// Request now has status: 'converted'
// Booking created with status: 'confirmed'

// 4. Event happens and ends
// 5. Automated task auto-completes
$statusManager->autoCompletePassedBookings();
// Booking now has status: 'completed'
```

### Example 2: Manual Booking Creation

```php
// Admin creates booking directly
$booking = $bookingService->createBooking([
    'client_id' => 1,
    'event_type_id' => 1,
    'start_time' => '2025-12-01 18:00',
    'end_time' => '2025-12-01 23:00',
    'capacity_adults' => 50,
    'capacity_children' => 20,
    'price' => 5000,
    'notes' => 'Annual Conference',
], [1, 2, 3]);
// Status: 'pending'

// Admin confirms after payment
$bookingService->confirmBooking($booking, 'Payment received');
// Status: 'pending' → 'confirmed'

// If client cancels
$bookingService->cancelBooking(
    $booking,
    'Client requested cancellation',
    'Full refund approved'
);
// Status: 'confirmed' → 'cancelled'
```

### Example 3: Checking Availability

```php
// Check if sections available
$availabilityChecker->checkSectionAvailability(
    [1, 2, 3],
    '2025-12-01 18:00',
    '2025-12-01 23:00'
);

// If throws exception, sections not available
// Otherwise, sections are bookable

// Get detailed status
$status = $availabilityChecker->getAvailabilityStatus(
    '2025-12-01 18:00',
    '2025-12-01 23:00'
);

// Array with:
// - available (Collection of available sections)
// - unavailable (Collection of booked sections)
// - available_count
// - unavailable_count
// - total_count
```

---

## 📋 Common Tasks

### Get Booking Details
```php
$booking = Booking::find($id);

// Basic info
$booking->booking_ref;
$booking->status;
$booking->total_cost;
$booking->total_paid;
$booking->remaining_balance;

// Relationships
$booking->client->name;
$booking->sections;
$booking->payments;

// Status checks
$booking->isConfirmed();
$booking->isPending();
$booking->isCancelled();
$booking->isFullyPaid();

// History
$booking->statusHistories;
```

### Get Booking Request Details
```php
$request = BookingRequest::find($id);

// Status
$request->status;
$request->isPending();
$request->canBeConverted();

// If converted
$request->convertedBooking;

// If rejected
$request->rejection_reason;
```

### Track Status Changes
```php
$booking = Booking::find($id);
$manager = app(BookingStatusManager::class);

// Get full history
$history = $manager->getStatusHistory($booking);

// Get timeline for display
$timeline = $manager->getStatusTimeline($booking);

// Get summary stats
$summary = $manager->getStatusSummary();
// ['pending' => 5, 'confirmed' => 12, 'cancelled' => 2, 'completed' => 45]
```

---

## ⚙️ Configuration

### Add to `.env` (if needed)
```
# Booking settings
BOOKING_AUTO_COMPLETE_PASSED=true
BOOKING_HOLD_TIME=24 # hours
```

### Create Scheduled Task (if auto-completing)
In `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    // Auto-complete passed bookings daily
    $schedule->call(function () {
        app(BookingStatusManager::class)->autoCompletePassedBookings();
    })->daily()->at('00:01');
}
```

---

## 🐛 Troubleshooting

### Issue: "Cannot transition from 'pending' to 'completed'"
**Solution:** Bookings can only be completed from 'confirmed' status. Confirm first.

### Issue: "Section not available for date range"
**Solution:** Check `booking_status_histories` to see what dates are booked. The availability checker looks at ALL confirmed/pending bookings, not just the current one.

### Issue: "Booking request not found"
**Solution:** Check that `booking_request_id` exists and booking_requests table has the record.

### Issue: "Service not found"
**Solution:** Make sure to run migrations and register the service provider in `config/app.php`.

---

## 📞 Support

For questions about the new booking system, refer to:
1. `BOOKING_ENGINE_OVERHAUL.md` - Complete overview
2. Model PHPDoc comments - Detailed method documentation
3. Service class documentation - Business logic explanation

---

**Last Updated:** 2025-10-21
**Version:** 1.0
**Status:** Ready for Production
