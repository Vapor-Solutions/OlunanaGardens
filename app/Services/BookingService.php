<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingRequest;
use App\Models\Client;
use App\Models\Section;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

/**
 * BookingService
 *
 * Handles all booking business logic including:
 * - Creating bookings
 * - Confirming bookings
 * - Cancelling bookings
 * - Converting booking requests to bookings
 * - Validating booking data
 */
class BookingService
{
    protected AvailabilityChecker $availabilityChecker;
    protected BookingStatusManager $statusManager;

    public function __construct(
        AvailabilityChecker $availabilityChecker,
        BookingStatusManager $statusManager
    ) {
        $this->availabilityChecker = $availabilityChecker;
        $this->statusManager = $statusManager;
    }

    /**
     * Create a new booking
     *
     * @param array $data Booking data
     * @param array $sectionIds Section IDs to assign
     * @return Booking
     * @throws Exception
     */
    public function createBooking(array $data, array $sectionIds = []): Booking
    {
        // Validate booking data
        $this->validateBookingData($data);

        // Check availability
        $this->availabilityChecker->checkSectionAvailability(
            $sectionIds,
            $data['start_time'],
            $data['end_time']
        );

        try {
            // Create booking
            $booking = Booking::create([
                ...$data,
                'booking_ref' => $this->generateBookingReference(),
                'status' => Booking::STATUS_PENDING,
            ]);

            // Attach sections
            if (!empty($sectionIds)) {
                $booking->sections()->attach($sectionIds);
            }

            return $booking;
        } catch (Exception $e) {
            throw new Exception("Failed to create booking: {$e->getMessage()}");
        }
    }

    /**
     * Convert a booking request to a booking
     *
     * @param BookingRequest $request
     * @param array $sectionIds Section IDs to assign
     * @param string|null $adminNotes Admin notes
     * @return Booking
     * @throws Exception
     */
    public function convertRequestToBooking(
        BookingRequest $request,
        array $sectionIds = [],
        ?string $adminNotes = null
    ): Booking {
        if (!$request->canBeConverted()) {
            throw new Exception("Booking request cannot be converted from status: {$request->status}");
        }

        try {
            // Check availability
            if (!empty($sectionIds)) {
                $this->availabilityChecker->checkSectionAvailability(
                    $sectionIds,
                    $request->start_time,
                    $request->end_time
                );
            }

            // Create booking from request data
            $booking = Booking::create([
                'client_id' => $request->client_id,
                'event_type_id' => $request->event_type_id,
                'package_id' => $request->package_id,
                'booking_request_id' => $request->id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'capacity_adults' => $request->capacity_adults,
                'capacity_children' => $request->capacity_children,
                'price' => $request->eventType->price ?? 0,
                'booking_ref' => $this->generateBookingReference(),
                'status' => Booking::STATUS_CONFIRMED,
                'confirmed_at' => now(),
                'notes' => $request->special_requests,
            ]);

            // Attach sections
            if (!empty($sectionIds)) {
                $booking->sections()->attach($sectionIds);
            }

            // Mark request as converted
            $request->markAsConverted($booking, $adminNotes);

            // Record status change
            $this->statusManager->recordStatusChange(
                $booking,
                null,
                Booking::STATUS_CONFIRMED,
                auth()->id(),
                "Converted from booking request #{$request->id}",
                ['booking_request_id' => $request->id]
            );

            return $booking;
        } catch (Exception $e) {
            throw new Exception("Failed to convert booking request: {$e->getMessage()}");
        }
    }

    /**
     * Confirm a booking (change status from pending to confirmed)
     *
     * @param Booking $booking
     * @param string|null $adminNotes Admin notes
     * @return bool
     */
    public function confirmBooking(Booking $booking, ?string $adminNotes = null): bool
    {
        if (!$booking->isPending()) {
            throw new Exception("Cannot confirm booking with status: {$booking->status}");
        }

        return $this->statusManager->changeStatus(
            $booking,
            Booking::STATUS_CONFIRMED,
            auth()->id(),
            "Booking confirmed by admin",
            ['admin_notes' => $adminNotes]
        );
    }

    /**
     * Cancel a booking
     *
     * @param Booking $booking
     * @param string $reason Cancellation reason
     * @param string|null $adminNotes Admin notes
     * @return bool
     */
    public function cancelBooking(
        Booking $booking,
        string $reason = '',
        ?string $adminNotes = null
    ): bool {
        if ($booking->isCancelled()) {
            throw new Exception("Booking is already cancelled");
        }

        $booking->update([
            'cancellation_reason' => $reason,
            'cancelled_at' => now(),
        ]);

        return $this->statusManager->changeStatus(
            $booking,
            Booking::STATUS_CANCELLED,
            auth()->id(),
            "Booking cancelled: {$reason}",
            ['admin_notes' => $adminNotes, 'reason' => $reason]
        );
    }

    /**
     * Update booking sections
     *
     * @param Booking $booking
     * @param array $sectionIds
     * @return void
     * @throws Exception
     */
    public function updateSections(Booking $booking, array $sectionIds): void
    {
        // Check availability
        $this->availabilityChecker->checkSectionAvailability(
            $sectionIds,
            $booking->start_time,
            $booking->end_time,
            $booking->id // Exclude current booking
        );

        // Update sections
        $booking->sections()->sync($sectionIds);
    }

    /**
     * Validate booking data
     *
     * @param array $data
     * @throws Exception
     */
    protected function validateBookingData(array $data): void
    {
        // Check required fields
        $required = ['client_id', 'event_type_id', 'start_time', 'end_time', 'capacity_adults', 'capacity_children'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new Exception("Missing required field: {$field}");
            }
        }

        // Parse dates
        $startTime = Carbon::parse($data['start_time']);
        $endTime = Carbon::parse($data['end_time']);

        // Validate date range
        if ($startTime->gte($endTime)) {
            throw new Exception("Start time must be before end time");
        }

        // Check if client exists
        if (!Client::find($data['client_id'])) {
            throw new Exception("Client not found");
        }

        // Check capacity
        if ($data['capacity_adults'] < 0 || $data['capacity_children'] < 0) {
            throw new Exception("Capacity cannot be negative");
        }

        if ($data['capacity_adults'] + $data['capacity_children'] <= 0) {
            throw new Exception("At least one guest is required");
        }
    }

    /**
     * Generate unique booking reference
     *
     * @return string
     */
    protected function generateBookingReference(): string
    {
        do {
            $ref = strtoupper(Str::random(8));
        } while (Booking::where('booking_ref', $ref)->exists());

        return $ref;
    }
}
