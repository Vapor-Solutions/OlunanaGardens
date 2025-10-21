<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingStatusHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * BookingStatusManager
 *
 * Handles booking status transitions and audit trail.
 * Records all status changes with reason and metadata.
 */
class BookingStatusManager
{
    /**
     * Change booking status with validation and audit trail
     *
     * @param Booking $booking
     * @param string $newStatus
     * @param int|null $userId
     * @param string|null $reason
     * @param array|null $metadata
     * @return bool
     * @throws Exception
     */
    public function changeStatus(
        Booking $booking,
        string $newStatus,
        ?int $userId = null,
        ?string $reason = null,
        ?array $metadata = null
    ): bool {
        // Validate status transition
        $this->validateStatusTransition($booking->status, $newStatus);

        return DB::transaction(function () use ($booking, $newStatus, $userId, $reason, $metadata) {
            $oldStatus = $booking->status;

            // Update booking status
            $booking->update([
                'status' => $newStatus,
                'confirmed_at' => $newStatus === Booking::STATUS_CONFIRMED ? now() : $booking->confirmed_at,
                'cancelled_at' => $newStatus === Booking::STATUS_CANCELLED ? now() : $booking->cancelled_at,
            ]);

            // Record status change
            $this->recordStatusChange($booking, $oldStatus, $newStatus, $userId, $reason, $metadata);

            return true;
        });
    }

    /**
     * Record status change in history
     *
     * @param Booking $booking
     * @param string|null $fromStatus
     * @param string $toStatus
     * @param int|null $userId
     * @param string|null $reason
     * @param array|null $metadata
     * @return BookingStatusHistory
     */
    public function recordStatusChange(
        Booking $booking,
        ?string $fromStatus,
        string $toStatus,
        ?int $userId = null,
        ?string $reason = null,
        ?array $metadata = null
    ): BookingStatusHistory {
        return BookingStatusHistory::create([
            'booking_id' => $booking->id,
            'from_status' => $fromStatus,
            'to_status' => $toStatus,
            'changed_by_user_id' => $userId ?? auth()->id(),
            'reason' => $reason,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Get booking status history
     *
     * @param Booking $booking
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getStatusHistory(Booking $booking)
    {
        return $booking->statusHistories()
            ->with('changedByUser:id,name,email')
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * Get status timeline for display
     *
     * @param Booking $booking
     * @return array
     */
    public function getStatusTimeline(Booking $booking): array
    {
        return $this->getStatusHistory($booking)
            ->map(function (BookingStatusHistory $history) {
                return [
                    'from' => $history->from_status,
                    'to' => $history->to_status,
                    'timestamp' => $history->created_at,
                    'user' => $history->changedByUser?->name ?? 'System',
                    'reason' => $history->reason,
                    'transition' => $history->status_transition,
                ];
            })
            ->toArray();
    }

    /**
     * Validate status transition
     *
     * @param string $currentStatus
     * @param string $newStatus
     * @throws Exception
     */
    protected function validateStatusTransition(string $currentStatus, string $newStatus): void
    {
        $allowedTransitions = [
            // From pending
            Booking::STATUS_PENDING => [
                Booking::STATUS_CONFIRMED,
                Booking::STATUS_CANCELLED,
            ],
            // From confirmed
            Booking::STATUS_CONFIRMED => [
                Booking::STATUS_CANCELLED,
                Booking::STATUS_COMPLETED,
            ],
            // From cancelled
            Booking::STATUS_CANCELLED => [
                // Cancelled bookings cannot transition
            ],
            // From completed
            Booking::STATUS_COMPLETED => [
                // Completed bookings cannot transition
            ],
        ];

        $allowed = $allowedTransitions[$currentStatus] ?? [];

        if (!in_array($newStatus, $allowed)) {
            throw new Exception(
                "Cannot transition from '{$currentStatus}' to '{$newStatus}'. "
                . "Allowed transitions: " . implode(', ', $allowed ?: ['none'])
            );
        }
    }

    /**
     * Auto-complete bookings that have passed their end_time
     *
     * @return int Number of completed bookings
     */
    public function autoCompletePassedBookings(): int
    {
        $now = now();
        $completed = 0;

        Booking::query()
            ->where('status', Booking::STATUS_CONFIRMED)
            ->where('end_time', '<', $now)
            ->chunk(100, function ($bookings) use (&$completed) {
                foreach ($bookings as $booking) {
                    try {
                        $this->changeStatus(
                            $booking,
                            Booking::STATUS_COMPLETED,
                            null,
                            'Automatically completed (booking period ended)'
                        );
                        $completed++;
                    } catch (Exception $e) {
                        \Log::error("Failed to auto-complete booking {$booking->id}: {$e->getMessage()}");
                    }
                }
            });

        return $completed;
    }

    /**
     * Get status summary statistics
     *
     * @return array
     */
    public function getStatusSummary(): array
    {
        return [
            'pending' => Booking::where('status', Booking::STATUS_PENDING)->count(),
            'confirmed' => Booking::where('status', Booking::STATUS_CONFIRMED)->count(),
            'cancelled' => Booking::where('status', Booking::STATUS_CANCELLED)->count(),
            'completed' => Booking::where('status', Booking::STATUS_COMPLETED)->count(),
        ];
    }
}
