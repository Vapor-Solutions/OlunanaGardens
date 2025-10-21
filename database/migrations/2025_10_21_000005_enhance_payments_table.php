<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Enhance payments table with better tracking.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Add payment date if not exists (when payment was actually made)
            if (!Schema::hasColumn('payments', 'payment_date')) {
                $table->timestamp('payment_date')->nullable()->after('amount');
            }

            // Add payment notes
            if (!Schema::hasColumn('payments', 'notes')) {
                $table->text('notes')->nullable()->after('payment_date');
            }

            // Add failed reason tracking
            if (!Schema::hasColumn('payments', 'failure_reason')) {
                $table->text('failure_reason')->nullable()->after('notes');
            }

            // Add confirmation code
            if (!Schema::hasColumn('payments', 'confirmation_code')) {
                $table->string('confirmation_code')->unique()->nullable()->after('reference_code');
            }

            // Create indexes for common queries
            $table->index('status');
            $table->index(['booking_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['booking_id', 'status']);

            if (Schema::hasColumn('payments', 'payment_date')) {
                $table->dropColumn('payment_date');
            }
            if (Schema::hasColumn('payments', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('payments', 'failure_reason')) {
                $table->dropColumn('failure_reason');
            }
            if (Schema::hasColumn('payments', 'confirmation_code')) {
                $table->dropColumn('confirmation_code');
            }
        });
    }
};
