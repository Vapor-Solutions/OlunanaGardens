<?php

namespace App\Livewire\Admin\BookingRequests;

use App\Models\BookingRequest;
use App\Models\Section;
use App\Services\BookingService;
use App\Services\AvailabilityChecker;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Admin Booking Requests Index Component
 *
 * Displays list of booking requests with filtering, search, and approval workflow
 */
#[Modelable]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    // Search and filter properties
    public ?string $search = '';
    public ?string $status = '';
    public ?string $sortBy = 'created_at';
    public ?string $sortDirection = 'desc';

    // Modal properties
    public ?int $requestToConvert = 0;
    public ?array $selected_sections = [];
    public ?string $adminNotes = '';
    public ?bool $showConvertModal = false;
    public ?bool $showRejectModal = false;
    public ?string $rejectionReason = '';
    public ?int $requestToReject = 0;

    // UI state
    public ?int $perPage = 10;

    // Services (not public properties - instantiated in methods)
    private ?BookingService $bookingService = null;
    private ?AvailabilityChecker $availabilityChecker = null;

    public function mount(): void
    {
        $this->bookingService = app(BookingService::class);
        $this->availabilityChecker = app(AvailabilityChecker::class);
    }

    /**
     * Get filtered booking requests
     */
    #[Computed]
    public function bookingRequests()
    {
        return BookingRequest::query()
            ->with(['client', 'eventType', 'package', 'convertedBooking'])
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->whereHas('client', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%');
                    })
                        ->orWhereHas('eventType', function ($q) {
                            $q->where('title', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    /**
     * Get available sections for a request
     */
    #[Computed]
    public function availableSections()
    {
        if (!$this->requestToConvert) {
            return collect();
        }

        $request = BookingRequest::find($this->requestToConvert);
        if (!$request) {
            return collect();
        }

        try {
            $status = $this->availabilityChecker->getAvailabilityStatus(
                $request->start_time->format('Y-m-d\TH:i'),
                $request->end_time->format('Y-m-d\TH:i')
            );
            return $status['available'];
        } catch (\Exception $e) {
            return collect();
        }
    }

    /**
     * Update sort direction
     */
    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    /**
     * Reset all filters
     */
    public function resetFilters(): void
    {
        $this->search = '';
        $this->status = '';
        $this->resetPage();
    }

    /**
     * Show convert modal
     */
    public function showConvertModal(int $requestId): void
    {
        $this->requestToConvert = $requestId;
        $this->selected_sections = [];
        $this->adminNotes = '';
        $this->showConvertModal = true;
    }

    /**
     * Show reject modal
     */
    public function showRejectModal(int $requestId): void
    {
        $this->requestToReject = $requestId;
        $this->rejectionReason = '';
        $this->showRejectModal = true;
    }

    /**
     * Convert request to booking
     */
    public function convertToBooking(): void
    {
        try {
            if (empty($this->selected_sections)) {
                $this->addError('selected_sections', 'Please select at least one section');
                return;
            }

            $request = BookingRequest::findOrFail($this->requestToConvert);

            if (!$request->canBeConverted()) {
                session()->flash('warning', 'This request cannot be converted in its current status');
                return;
            }

            // Create booking from request
            $booking = $this->bookingService->convertRequestToBooking(
                $request,
                $this->selected_sections,
                $this->adminNotes
            );

            // Mark request as converted
            $request->markAsConverted($booking, $this->adminNotes);

            session()->flash('success', "Booking #{$booking->booking_ref} created successfully from request!");
            $this->showConvertModal = false;
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', "Failed to convert request: {$e->getMessage()}");
        }
    }

    /**
     * Reject booking request
     */
    public function rejectRequest(): void
    {
        try {
            if (empty($this->rejectionReason)) {
                $this->addError('rejectionReason', 'Please provide a rejection reason');
                return;
            }

            $request = BookingRequest::findOrFail($this->requestToReject);

            if (!$request->isPending() && !$request->isAccepted()) {
                session()->flash('warning', 'This request cannot be rejected in its current status');
                return;
            }

            $request->markAsRejected($this->rejectionReason, $this->adminNotes);

            session()->flash('success', "Request has been rejected successfully");
            $this->showRejectModal = false;
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', "Failed to reject request: {$e->getMessage()}");
        }
    }

    /**
     * Accept booking request
     */
    public function acceptRequest(int $requestId): void
    {
        try {
            $request = BookingRequest::findOrFail($requestId);

            if (!$request->isPending()) {
                session()->flash('warning', 'This request is no longer pending');
                return;
            }

            $request->markAsAccepted('Accepted by admin');
            session()->flash('success', 'Request accepted successfully');
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', "Failed to accept request: {$e->getMessage()}");
        }
    }

    public function render()
    {
        return view('livewire.admin.booking-requests.index');
    }
}
