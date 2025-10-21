<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create booking_status_histories table to track all status changes.
     * Provides audit trail for booking workflow.
     */
    public function up(): void
    {
        Schema::create('booking_status_histories', function (Blueprint $table) {
            $table->id();

            // Foreign key to booking
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();

            // The status that was changed from
            $table->string('from_status')->nullable();

            // The status that was changed to
            $table->string('to_status');

            // Who made this status change (admin user id)
            $table->foreignId('changed_by_user_id')->nullable()->constrained('users')->nullOnDelete();

            // Reason for status change
            $table->text('reason')->nullable();

            // Additional data/notes about the change
            $table->json('metadata')->nullable();

            $table->timestamps();

            // Indexes for queries
            $table->index('booking_id');
            $table->index('to_status');
            $table->index(['booking_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_status_histories');
    }
};
