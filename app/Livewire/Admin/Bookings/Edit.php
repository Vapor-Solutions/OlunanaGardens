<?php

namespace App\Livewire\Admin\Bookings;

use App\Models\Booking;
use App\Models\Client;
use App\Models\EventType;
use App\Models\Package;
use App\Models\Section;
use App\Services\AvailabilityChecker;
use App\Services\BookingService;
use App\Services\BookingStatusManager;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Edit Booking Component
 *
 * Allows admins to edit existing bookings with status awareness
 * Restricts certain edits based on booking status
 */
class Edit extends Component
{
    public Booking $booking;

    // Selects
    public $clients = [];
    public $eventTypes = [];
    public $packages = [];
    public $availableSections = [];
    public $allSections = [];

    // Form properties

    public array $selected_sections = [];

    // UI state
    public ?string $availabilityMessage = '';
    public ?bool $availabilityOk = false;
    public ?bool $canEditDates = false;
    public ?bool $showStatusHistory = false;

    // Services (not public properties - instantiated in methods)
    private ?AvailabilityChecker $availabilityChecker = null;
    private ?BookingService $bookingService = null;
    private ?BookingStatusManager $statusManager = null;

    public function rules()
    {
        return [
            'booking.client_id' => 'required|exists:clients,id',
            'booking.event_type_id' => 'required|exists:event_types,id',
            'booking.start_time' => 'required|date_format:Y-m-d\TH:i|before:end_time',
            'booking.end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
            'booking.capacity_adults' => 'required|integer|min:0',
            'booking.capacity_children' => 'required|integer|min:0',
            'booking.price' => 'required|numeric|min:0',
            'selected_sections' => 'required|array|min:1',
            'selected_sections.*' => 'exists:sections,id',
        ];
    }

    public function mount($id): void
    {
        $this->booking = Booking::findOrFail($id)->load(['client', 'eventType', 'package', 'sections', 'statusHistories', 'payments']);

        // Initialize services
        $this->availabilityChecker = app(AvailabilityChecker::class);
        $this->bookingService = app(BookingService::class);
        $this->statusManager = app(BookingStatusManager::class);

        // Load selects
        $this->loadSelects();

        // Populate form fields from booking
        $this->selected_sections = $this->booking->sections->pluck('id')->toArray();

        // Determine if dates can be edited (only if pending or within a certain time frame)
        $this->canEditDates = $this->booking->isPending() ||
            (!$this->booking->isCompleted() && Carbon::parse($this->booking->start_time)->isFuture());

        $this->checkAvailability();
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
     * Load dropdown options
     */
    public function loadSelects(): void
    {
        $this->clients = Client::orderBy('name')->get();
        $this->eventTypes = EventType::orderBy('title')->get();
        $this->packages = Package::orderBy('title')->get();
        $this->allSections = Section::orderBy('name')->get();
    }

    /**
     * Update event type and reset package if needed
     */
    #[On('update:booking.event_type_id')]
    public function updateEventType(): void
    {
        $this->booking->package_id = null;
        $this->updatePrice();
    }

    /**
     * Update package price
     */
    #[On('update:booking.package_id')]
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
    #[On('update:booking.start_time')]
    #[On('update:booking.end_time')]
    public function checkAvailability(): void
    {
        if (!$this->booking->start_time || !$this->booking->end_time) {
            $this->availableSections = $this->allSections;
            $this->availabilityMessage = '';
            $this->availabilityOk = false;
            return;
        }

        try {
            $status = $this->availabilityChecker->getAvailabilityStatus(
                $this->booking->start_time,
                $this->booking->end_time,
                $this->booking->id // Exclude current booking from conflict check
            );

            $this->availableSections = $status['available'];
            $this->availabilityOk = $status['available_count'] > 0;
            $this->availabilityMessage = "{$status['available_count']} of {$status['total_count']} sections available";

            // Keep currently selected sections even if they weren't in the new availability list
            $availableIds = $this->availableSections->pluck('id')->toArray();
            $currentlySelected = $this->booking->sections->pluck('id')->toArray();

            // Allow keeping sections that are currently booked to this booking
            $allowedSections = array_merge($availableIds, $currentlySelected);
            $this->selected_sections = array_filter(
                $this->selected_sections,
                fn($id) => in_array($id, $allowedSections)
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
     * Get status history
     */
    #[Computed]
    public function statusHistory()
    {
        return $this->booking->statusHistories()
            ->orderBy('created_at', 'desc')
            ->get();
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
     * Save booking changes
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

            // Store original dates for comparison
            $originalStartTime = $this->booking->getOriginal('start_time');
            $originalEndTime = $this->booking->getOriginal('end_time');

            // Check if dates have changed and booking is confirmed
            $datesChanged = $this->booking->start_time !== $originalStartTime ||
                $this->booking->end_time !== $originalEndTime;

            if ($datesChanged && $this->booking->isConfirmed()) {
                session()->flash('warning', 'Cannot modify dates for confirmed bookings. Cancel and create a new booking instead.');
                return;
            }

            // Update booking directly since booking is a model property
            $this->booking->save();

            // Update sections
            $this->booking->sections()->sync($this->selected_sections);

            session()->flash('success', "Booking #{$this->booking->booking_ref} updated successfully!");
            $this->redirect(route('admin.bookings.index'));
        } catch (\Exception $e) {
            session()->flash('error', "Failed to update booking: {$e->getMessage()}");
        }
    }

    public function render()
    {
        return view('livewire.admin.bookings.edit');
    }
}
