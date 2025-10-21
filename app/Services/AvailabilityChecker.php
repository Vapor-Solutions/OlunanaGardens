<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Section;
use Carbon\Carbon;
use Exception;

/**
 * AvailabilityChecker
 *
 * Checks section availability for booking date ranges.
 * Ensures no double-booking of sections.
 */
class AvailabilityChecker
{
    /**
     * Check if sections are available for a date range
     *
     * @param array $sectionIds Section IDs to check
     * @param Carbon|string $startTime Start date/time
     * @param Carbon|string $endTime End date/time
     * @param int|null $excludeBookingId Booking ID to exclude from check (for updates)
     * @return bool
     * @throws Exception
     */
    public function checkSectionAvailability(
        array $sectionIds,
        Carbon|string $startTime,
        Carbon|string $endTime,
        ?int $excludeBookingId = null
    ): bool {
        if (empty($sectionIds)) {
            return true;
        }

        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        $unavailableSections = [];

        foreach ($sectionIds as $sectionId) {
            if (!$this->isSectionAvailable($sectionId, $startTime, $endTime, $excludeBookingId)) {
                $section = Section::find($sectionId);
                $unavailableSections[] = $section?->name ?? "Section {$sectionId}";
            }
        }

        if (!empty($unavailableSections)) {
            $sections = implode(', ', $unavailableSections);
            throw new Exception("The following sections are not available for the selected dates: {$sections}");
        }

        return true;
    }

    /**
     * Check if a single section is available
     *
     * @param int $sectionId
     * @param Carbon $startTime
     * @param Carbon $endTime
     * @param int|null $excludeBookingId
     * @return bool
     */
    public function isSectionAvailable(
        int $sectionId,
        Carbon $startTime,
        Carbon $endTime,
        ?int $excludeBookingId = null
    ): bool {
        $query = Booking::query()
            ->where('status', '!=', Booking::STATUS_CANCELLED)
            ->whereHas('sections', function ($query) use ($sectionId) {
                $query->where('section_id', $sectionId);
            });

        // Exclude booking if specified (for updates)
        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }

        // Check for overlapping bookings
        $conflictingBooking = $query
            ->where(function ($query) use ($startTime, $endTime) {
                // Booking starts before or during our period
                $query->whereRaw('start_time <= ?', [$endTime])
                    // And booking ends after or during our period
                    ->whereRaw('end_time >= ?', [$startTime]);
            })
            ->first();

        return $conflictingBooking === null;
    }

    /**
     * Get available sections for a date range
     *
     * @param Carbon|string $startTime
     * @param Carbon|string $endTime
     * @param int|null $excludeBookingId Booking ID to exclude from check
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAvailableSections(Carbon|string $startTime, Carbon|string $endTime, ?int $excludeBookingId = null)
    {
        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        return Section::whereDoesntHave('bookings', function ($query) use ($startTime, $endTime, $excludeBookingId) {
            $query->where('status', '!=', Booking::STATUS_CANCELLED)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereRaw('start_time <= ?', [$endTime])
                        ->whereRaw('end_time >= ?', [$startTime]);
                });

            // Exclude specific booking if provided
            if ($excludeBookingId) {
                $query->where('booking_id', '!=', $excludeBookingId);
            }
        })->get();
    }

    /**
     * Get unavailable sections for a date range
     *
     * @param Carbon|string $startTime
     * @param Carbon|string $endTime
     * @param int|null $excludeBookingId Booking ID to exclude from check
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUnavailableSections(Carbon|string $startTime, Carbon|string $endTime, ?int $excludeBookingId = null)
    {
        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        return Section::whereHas('bookings', function ($query) use ($startTime, $endTime, $excludeBookingId) {
            $query->where('status', '!=', Booking::STATUS_CANCELLED)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereRaw('start_time <= ?', [$endTime])
                        ->whereRaw('end_time >= ?', [$startTime]);
                });

            // Exclude specific booking if provided
            if ($excludeBookingId) {
                $query->where('booking_id', '!=', $excludeBookingId);
            }
        })->get();
    }

    /**
     * Get availability status for all sections
     *
     * @param Carbon|string $startTime
     * @param Carbon|string $endTime
     * @param int|null $excludeBookingId Booking ID to exclude from check (for updates)
     * @return array
     */
    public function getAvailabilityStatus(Carbon|string $startTime, Carbon|string $endTime, ?int $excludeBookingId = null): array
    {
        $available = $this->getAvailableSections($startTime, $endTime, $excludeBookingId);
        $unavailable = $this->getUnavailableSections($startTime, $endTime, $excludeBookingId);

        return [
            'available' => $available,
            'unavailable' => $unavailable,
            'available_count' => $available->count(),
            'unavailable_count' => $unavailable->count(),
            'total_count' => Section::count(),
        ];
    }
}
