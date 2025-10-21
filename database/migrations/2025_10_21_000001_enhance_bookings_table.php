<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add status and notes columns to bookings table.
     * Status tracks: pending, confirmed, cancelled, completed
     * This enables proper booking workflow management.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Check if columns don't already exist before adding them
            if (!Schema::hasColumn('bookings', 'status')) {
                // Add status column with default 'pending'
                $table->string('status')->default('pending');
                // pending: awaiting confirmation
                // confirmed: admin has confirmed
                // cancelled: booking was cancelled
                // completed: event has passed
            }

            if (!Schema::hasColumn('bookings', 'notes')) {
                // Add notes for special requirements
                $table->longText('notes')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'cancellation_reason')) {
                // Add cancellation reason tracking
                $table->string('cancellation_reason')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'confirmed_at')) {
                // Add confirmation timestamp
                $table->timestamp('confirmed_at')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'cancelled_at')) {
                // Add cancellation timestamp
                $table->timestamp('cancelled_at')->nullable();
            }

            // Create index for status for fast filtering if not exists
            try {
                $table->index('status');
            } catch (\Exception $e) {
                // Index might already exist
            }

            // Create composite index for common queries if not exists
            try {
                $table->index(['client_id', 'status']);
            } catch (\Exception $e) {
                // Index might already exist
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['client_id', 'status']);
            $table->dropColumn([
                'status',
                'notes',
                'cancellation_reason',
                'confirmed_at',
                'cancelled_at'
            ]);
        });
    }
};
