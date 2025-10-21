<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * BookingStatusHistory Model
 *
 * Tracks all status changes for a booking to provide audit trail.
 */
class BookingStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'from_status',
        'to_status',
        'changed_by_user_id',
        'reason',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the booking this history belongs to
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the user who made this change
     */
    public function changedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }

    /**
     * Get formatted status transition
     */
    public function getStatusTransitionAttribute(): string
    {
        $from = $this->from_status ?? 'N/A';
        $to = $this->to_status ?? 'N/A';
        return "{$from} → {$to}";
    }
}
