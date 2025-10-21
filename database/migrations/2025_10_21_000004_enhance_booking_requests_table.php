<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Enhance booking_requests table with status tracking and admin notes.
     */
    public function up(): void
    {
        Schema::table('booking_requests', function (Blueprint $table) {
            // Check if columns don't already exist before adding them
            if (!Schema::hasColumn('booking_requests', 'status')) {
                // Status: pending, accepted, rejected, converted
                $table->string('status')->default('pending');
            }

            if (!Schema::hasColumn('booking_requests', 'admin_notes')) {
                // Admin notes for processing the request
                $table->longText('admin_notes')->nullable();
            }

            if (!Schema::hasColumn('booking_requests', 'converted_at')) {
                // Track when request was converted to booking
                $table->timestamp('converted_at')->nullable();
            }

            if (!Schema::hasColumn('booking_requests', 'converted_to_booking_id')) {
                // Track the booking created from this request
                $table->foreignId('converted_to_booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            }

            if (!Schema::hasColumn('booking_requests', 'rejection_reason')) {
                // Track rejection reason
                $table->text('rejection_reason')->nullable();
            }

            if (!Schema::hasColumn('booking_requests', 'rejected_at')) {
                // Timestamp for when rejected
                $table->timestamp('rejected_at')->nullable();
            }

            // Create indexes if they don't exist
            try {
                $table->index('status');
            } catch (\Exception $e) {
                // Index might already exist
            }

            try {
                $table->index('converted_to_booking_id');
            } catch (\Exception $e) {
                // Index might already exist
            }
        });
    }

    public function down(): void
    {
        Schema::table('booking_requests', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['converted_to_booking_id']);
            $table->dropForeign(['converted_to_booking_id']);
            $table->dropColumn([
                'status',
                'admin_notes',
                'converted_at',
                'converted_to_booking_id',
                'rejection_reason',
                'rejected_at'
            ]);
        });
    }
};
