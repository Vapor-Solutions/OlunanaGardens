<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Booking Model
 *
 * Represents a confirmed booking for an event.
 * A booking can have multiple sections assigned to it.
 */
class Booking extends Model
{
    use HasFactory;

    /**
     * Booking status constants
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_COMPLETED = 'completed';

    /**
     * Get available statuses
     */
    public static function getAvailableStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending Confirmation',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_COMPLETED => 'Completed',
        ];
    }

    /**
     * CORRECTED fillable attributes to match database schema
     */
    protected $fillable = [
        'client_id',
        'event_type_id',
        'package_id',
        'booking_request_id',
        'booking_ref',
        'start_time',
        'end_time',
        'capacity_adults',
        'capacity_children',
        'price',
        'status',
        'notes',
        'cancellation_reason',
        'confirmed_at',
        'cancelled_at',
    ];

    /**
     * CORRECTED casts to use start_time and end_time
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Get the client associated with this booking
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get sections assigned to this booking (many-to-many)
     */
    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'booking_section')
            ->withPivot('quantity_reserved', 'special_instructions', 'setup_notes', 'is_confirmed')
            ->withTimestamps();
    }

    /**
     * Get the event type for this booking
     */
    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }

    /**
     * Get the package associated with this booking
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the booking request that created this booking
     */
    public function bookingRequest(): BelongsTo
    {
        return $this->belongsTo(BookingRequest::class);
    }

    /**
     * Get all payments for this booking
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the status history for this booking
     */
    public function statusHistories(): HasMany
    {
        return $this->hasMany(BookingStatusHistory::class);
    }

    /**
     * Get completed payments
     */
    public function completedPayments(): HasMany
    {
        return $this->hasMany(Payment::class)->where('status', 'completed');
    }

    /**
     * Check if the booking is currently active (between start_time and end_time)
     */
    public function isActiveDuring(Carbon|string $date): bool
    {
        if (!$this->start_time || !$this->end_time) {
            return false;
        }

        $date = Carbon::parse($date);
        return $date->isBetween(
            Carbon::parse($this->start_time)->subDay(),
            Carbon::parse($this->end_time)->addDay()
        );
    }

    /**
     * Check if booking overlaps with a date range
     */
    public function isActiveBetween(Carbon|string $date1, Carbon|string $date2): bool
    {
        if (!$this->start_time || !$this->end_time) {
            return false;
        }

        $startDate = Carbon::parse($date1);
        $endDate = Carbon::parse($date2);
        $bookingStart = Carbon::parse($this->start_time);
        $bookingEnd = Carbon::parse($this->end_time);

        return $startDate->lte($bookingEnd) && $endDate->gte($bookingStart);
    }

    /**
     * Get the total cost of the booking
     * Calculates based on capacity and price per unit
     * Formula: (capacity_adults * price) + (capacity_children * price * 0.5)
     */
    public function getTotalCostAttribute(): float
    {
        return ($this->capacity_adults * $this->price) + ($this->capacity_children * $this->price * 0.5);
    }

    /**
     * Check if the booking is currently active (right now)
     */
    public function getIsActiveAttribute(): bool
    {
        if (!$this->start_time || !$this->end_time) {
            return false;
        }

        $now = Carbon::now();
        return $now->isBetween(
            Carbon::parse($this->start_time),
            Carbon::parse($this->end_time)
        );
    }

    /**
     * Check if booking is confirmed
     */
    public function isConfirmed(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    /**
     * Check if booking is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    /**
     * Check if booking is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if booking is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Get total paid amount
     */
    public function getTotalPaidAttribute(): float
    {
        return $this->completedPayments()->sum('amount') ?? 0;
    }

    /**
     * Get remaining balance
     */
    public function getRemainingBalanceAttribute(): float
    {
        return $this->total_cost - $this->total_paid;
    }

    /**
     * Check if booking is fully paid
     */
    public function isFullyPaid(): bool
    {
        return $this->remaining_balance <= 0;
    }
}
