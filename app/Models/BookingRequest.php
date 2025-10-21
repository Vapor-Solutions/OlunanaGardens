<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * BookingRequest Model
 *
 * Represents a booking request from a customer.
 * Can be accepted (converted to Booking) or rejected.
 */
class BookingRequest extends Model
{
    use HasFactory;

    /**
     * Booking request status constants
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_CONVERTED = 'converted';

    /**
     * Get available statuses
     */
    public static function getAvailableStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending Review',
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_CONVERTED => 'Converted to Booking',
        ];
    }

    /**
     * CORRECTED fillable attributes to match database schema
     */
    protected $fillable = [
        'client_id',
        'event_type_id',
        'package_id',
        'start_time',
        'end_time',
        'capacity_adults',
        'capacity_children',
        'status',
        'notes',
        'special_requests',
        'admin_notes',
        'converted_at',
        'converted_to_booking_id',
        'rejection_reason',
        'rejected_at',
    ];

    /**
     * CORRECTED casts to use start_time and end_time
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'converted_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    /**
     * Get the client who made this request
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the event type for this request
     */
    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }

    /**
     * Get the package for this request
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the booking created from this request
     */
    public function convertedBooking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'converted_to_booking_id');
    }

    /**
     * Check if request is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if request is accepted
     */
    public function isAccepted(): bool
    {
        return $this->status === self::STATUS_ACCEPTED;
    }

    /**
     * Check if request is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Check if request was converted
     */
    public function isConverted(): bool
    {
        return $this->status === self::STATUS_CONVERTED;
    }

    /**
     * Check if request can be converted to booking
     */
    public function canBeConverted(): bool
    {
        return $this->isPending() || $this->isAccepted();
    }

    /**
     * Mark request as accepted
     */
    public function markAsAccepted(string $adminNotes = null): bool
    {
        return $this->update([
            'status' => self::STATUS_ACCEPTED,
            'admin_notes' => $adminNotes,
        ]);
    }

    /**
     * Mark request as rejected
     */
    public function markAsRejected(string $reason, string $adminNotes = null): bool
    {
        return $this->update([
            'status' => self::STATUS_REJECTED,
            'rejection_reason' => $reason,
            'admin_notes' => $adminNotes,
            'rejected_at' => now(),
        ]);
    }

    /**
     * Mark request as converted
     */
    public function markAsConverted(Booking $booking, string $adminNotes = null): bool
    {
        return $this->update([
            'status' => self::STATUS_CONVERTED,
            'converted_to_booking_id' => $booking->id,
            'converted_at' => now(),
            'admin_notes' => $adminNotes,
        ]);
    }

    /**
     * Calculate total cost for this request
     */
    public function calculateTotalCost(): float
    {
        $packagePrice = $this->package?->price ?? 0;
        $eventTypePrice = $this->eventType?->price ?? 0;
        $basePrice = $packagePrice > 0 ? $packagePrice : $eventTypePrice;

        return ($this->capacity_adults * $basePrice) + ($this->capacity_children * $basePrice * 0.5);
    }
}
