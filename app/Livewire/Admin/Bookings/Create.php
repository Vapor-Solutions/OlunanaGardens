<?php

namespace App\Livewire\Admin\Bookings;

use App\Mail\BookingReference;
use App\Models\Booking;
use App\Models\Client;
use App\Models\EventType;
use App\Models\Package;
use App\Models\Section;
use App\Services\AvailabilityChecker;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * Create Booking Component
 *
 * Allows admins to create new bookings with real-time calculations and availability checking
 */
class Create extends Component
{
    // Model binding for booking form
    public Booking $booking;

    // Selects
    public $clients = [];
    public $eventTypes = [];
    public $packages = [];
    public $sections = [];
    public $availableSections = [];

    // Form properties
    public ?array $selected_sections = [];

    // UI state
    public ?bool $showCostBreakdown = false;
    public ?string $availabilityMessage = '';
    public ?bool $availabilityOk = false;

    // Services (not public properties - instantiated in methods)
    private ?AvailabilityChecker $availabilityChecker = null;
    private ?BookingService $bookingService = null;

    public function mount(): void
    {
        // Create empty booking instance for model binding
        $this->booking = new Booking();
        $this->booking->capacity_adults = 1;
        $this->booking->capacity_children = 0;

        $this->availabilityChecker = app(AvailabilityChecker::class);
        $this->bookingService = app(BookingService::class);
        $this->loadSelects();
    }

    /**
     * Load dropdown options
     */
    public function loadSelects(): void
    {
        $this->clients = Client::orderBy('name')->get();
        $this->eventTypes = EventType::orderBy('title')->get();
        $this->packages = Package::orderBy('title')->get();
        $this->sections = Section::orderBy('name')->get();
    }

    /**
     * Update event type and reset package if needed
     */
    #[\Livewire\Attributes\On('update:booking.event_type_id')]
    public function updateEventType(): void
    {
        $this->booking->package_id = null;
        $this->updatePrice();
    }

    /**
     * Update package price
     */
    #[\Livewire\Attributes\On('update:booking.package_id')]
    public function updatePackage(): void
    {
        $this->updatePrice();
    }

    /**
     * Update price from package or event type
     */
    public function updatePrice(): void
    {
        if ($this->booking->package_id) {
            $package = Package::find($this->booking->package_id);
            $this->booking->price = $package?->price;
        } elseif ($this->booking->event_type_id) {
            $eventType = EventType::find($this->booking->event_type_id);
            $this->booking->price = $eventType?->price;
        } else {
            $this->booking->price = null;
        }
    }

    /**
     * Check section availability when dates change
     */
    #[\Livewire\Attributes\On('update:booking.start_time')]
    #[\Livewire\Attributes\On('update:booking.end_time')]
    public function checkAvailability(): void
    {
        if (!$this->booking->start_time || !$this->booking->end_time) {
            $this->availableSections = $this->sections;
            $this->availabilityMessage = '';
            $this->availabilityOk = false;
            return;
        }

        try {
            $status = $this->availabilityChecker->getAvailabilityStatus(
                $this->booking->start_time,
                $this->booking->end_time
            );

            $this->availableSections = $status['available'];
            $this->availabilityOk = $status['available_count'] > 0;
            $this->availabilityMessage = "{$status['available_count']} of {$status['total_count']} sections available";

            // Reset selected sections if they're no longer available
            $this->selected_sections = array_filter(
                $this->selected_sections,
                fn($id) => $this->availableSections->pluck('id')->contains($id)
            );
        } catch (\Exception $e) {
            $this->availabilityMessage = "Error checking availability: {$e->getMessage()}";
            $this->availabilityOk = false;
            $this->availableSections = [];
        }
    }

    /**
     * Calculate total cost
     */
    #[Computed]
    public function totalCost(): float
    {
        if (!$this->booking->price) {
            return 0;
        }

        return ($this->booking->capacity_adults * $this->booking->price) + ($this->booking->capacity_children * $this->booking->price * 0.5);
    }

    /**
     * Get cost breakdown
     */
    #[Computed]
    public function costBreakdown(): array
    {
        return [
            'adults_cost' => $this->booking->capacity_adults * ($this->booking->price ?? 0),
            'children_cost' => $this->booking->capacity_children * (($this->booking->price ?? 0) * 0.5),
            'total' => $this->totalCost(),
        ];
    }

    /**
     * Real-time validation on property update
     */
    public function updated($propertyName)
    {
        // Validate only the property that changed to provide real-time feedback
        try {
            match ($propertyName) {
                'booking.client_id' => $this->validateOnly('booking.client_id'),
                'booking.event_type_id' => $this->validateOnly('booking.event_type_id'),
                'booking.start_time' => $this->validateOnly('booking.start_time'),
                'booking.end_time' => $this->validateOnly('booking.end_time'),
                'booking.capacity_adults' => $this->validateOnly('booking.capacity_adults'),
                'booking.capacity_children' => $this->validateOnly('booking.capacity_children'),
                'booking.price' => $this->validateOnly('booking.price'),
                'selected_sections' => $this->validateOnly('selected_sections'),
                default => null,
            };
        } catch (\Exception $e) {
            // Validation exceptions are expected and handled by Livewire
        }
    }

    /**
     * Validate form
     */
    public function validateForm(): array
    {
        return $this->validate([
            'booking.client_id' => 'required|exists:clients,id',
            'booking.event_type_id' => 'required|exists:event_types,id',
            'booking.start_time' => 'required|date_format:Y-m-d\TH:i|before:end_time',
            'booking.end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
            'booking.capacity_adults' => 'required|integer|min:1',
            'booking.capacity_children' => 'required|integer|min:0',
            'booking.price' => 'required|numeric|min:0',
            'selected_sections' => 'required|array|min:1',
            'selected_sections.*' => 'exists:sections,id',
        ]);
    }

    /**
     * Create the booking
     */
    public function saveBooking(): void
    {
        try {
            $this->validateForm();

            // Check capacity
            if ($this->booking->capacity_adults + $this->booking->capacity_children === 0) {
                $this->addError('booking.capacity_adults', 'At least one guest is required');
                return;
            }

            // Create booking using service
            $booking = $this->bookingService->createBooking(
                [
                    'client_id' => $this->booking->client_id,
                    'event_type_id' => $this->booking->event_type_id,
                    'package_id' => $this->booking->package_id,
                    'start_time' => $this->booking->start_time,
                    'end_time' => $this->booking->end_time,
                    'capacity_adults' => $this->booking->capacity_adults,
                    'capacity_children' => $this->booking->capacity_children,
                    'price' => $this->booking->price,
                    'notes' => $this->booking->notes,
                ],
                $this->selected_sections
            );

            // Send confirmation email
            Mail::to($booking->client->email)->send(new BookingReference($booking));

            session()->flash('success', "Booking #{$booking->booking_ref} created successfully!");
            $this->redirect(route('admin.bookings.edit', $booking->id));
        } catch (\Exception $e) {
            session()->flash('error', "Failed to create booking: {$e->getMessage()}");
        }
    }

    public function render()
    {
        return view('livewire.admin.bookings.create');
    }
}
