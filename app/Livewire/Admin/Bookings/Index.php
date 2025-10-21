<?php

namespace App\Livewire\Admin\Bookings;

use App\Models\Booking;
use App\Services\BookingService;
use App\Services\BookingStatusManager;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Admin Bookings Index Component
 *
 * Displays list of bookings with advanced filtering, search, and management
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
    public ?string $dateFrom = '';
    public ?string $dateTo = '';

    // UI state
    public ?int $perPage = 10;
    public ?bool $showDeleteConfirm = false;
    public ?int $bookingToDelete = 0;

    // Services (not public properties - instantiated in methods)
    private ?BookingService $bookingService = null;
    private ?BookingStatusManager $statusManager = null;

    public function mount(): void
    {
        $this->bookingService = app(BookingService::class);
        $this->statusManager = app(BookingStatusManager::class);
    }

    /**
     * Get filtered bookings with search, status, and date filtering
     */
    #[Computed]
    public function bookings()
    {
        return Booking::query()
            ->with(['client', 'eventType', 'sections', 'payments'])
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->whereHas('client', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                        ->orWhere('booking_ref', 'like', '%' . $this->search . '%')
                        ->orWhereHas('eventType', function ($q) {
                            $q->where('title', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->dateFrom, function ($query) {
                return $query->whereDate('start_time', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                return $query->whereDate('start_time', '<=', $this->dateTo);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
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
        $this->dateFrom = '';
        $this->dateTo = '';
        $this->resetPage();
    }

    /**
     * Confirm a pending booking
     */
    public function confirmBooking(int $bookingId): void
    {
        try {
            $booking = Booking::findOrFail($bookingId);

            if (!$booking->isPending()) {
                session()->flash('warning', "Booking is not in pending status");
                return;
            }

            $this->bookingService->confirmBooking($booking, 'Confirmed by admin');
            session()->flash('success', "Booking #{$booking->booking_ref} confirmed successfully");
        } catch (\Exception $e) {
            session()->flash('error', "Failed to confirm booking: {$e->getMessage()}");
        }
    }

    /**
     * Show cancel confirmation
     */
    public function showCancelConfirm(int $bookingId): void
    {
        $booking = Booking::findOrFail($bookingId);

        if ($booking->isCancelled()) {
            session()->flash('warning', "This booking is already cancelled");
            return;
        }

        $this->dispatch('showCancelModal', bookingId: $bookingId);
    }

    /**
     * Cancel booking with reason
     */
    public function cancelBooking(int $bookingId, string $reason = ''): void
    {
        try {
            $booking = Booking::findOrFail($bookingId);

            $this->bookingService->cancelBooking(
                $booking,
                $reason ?: 'Cancelled by admin',
                "Cancelled by: " . auth()->user()->name
            );

            session()->flash('success', "Booking #{$booking->booking_ref} cancelled successfully");
        } catch (\Exception $e) {
            session()->flash('error', "Failed to cancel booking: {$e->getMessage()}");
        }
    }

    /**
     * Show delete confirmation
     */
    public function showDeleteConfirm(int $bookingId): void
    {
        $this->bookingToDelete = $bookingId;
        $this->showDeleteConfirm = true;
    }

    /**
     * Delete booking (only if pending)
     */
    public function deleteBooking(): void
    {
        try {
            $booking = Booking::findOrFail($this->bookingToDelete);

            if (!$booking->isPending()) {
                session()->flash('warning', "Can only delete pending bookings");
                return;
            }

            $ref = $booking->booking_ref;
            $booking->delete();

            session()->flash('success', "Booking #{$ref} deleted successfully");
            $this->showDeleteConfirm = false;
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', "Failed to delete booking: {$e->getMessage()}");
        }
    }

    /**
     * Get status summary for statistics
     */
    #[Computed]
    public function statusSummary()
    {
        return $this->statusManager->getStatusSummary();
    }

    public function render()
    {
        return view('livewire.admin.bookings.index');
    }
}
