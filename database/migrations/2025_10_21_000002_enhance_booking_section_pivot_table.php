<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Enhance booking_section pivot table with additional tracking columns.
     * Allows tracking quantity per section and section-specific instructions.
     */
    public function up(): void
    {
        Schema::table('booking_section', function (Blueprint $table) {
            // Check if columns don't already exist before adding them
            if (!Schema::hasColumn('booking_section', 'quantity_reserved')) {
                // Add quantity reserved (how many of this section type)
                $table->integer('quantity_reserved')->default(1);
            }

            if (!Schema::hasColumn('booking_section', 'special_instructions')) {
                // Add section-specific instructions
                $table->text('special_instructions')->nullable();
            }

            if (!Schema::hasColumn('booking_section', 'setup_notes')) {
                // Add setup/teardown notes
                $table->text('setup_notes')->nullable();
            }

            if (!Schema::hasColumn('booking_section', 'is_confirmed')) {
                // Track if this section was confirmed
                $table->boolean('is_confirmed')->default(false);
            }

            // Create indexes for common queries if they don't exist
            try {
                $table->index(['booking_id', 'section_id']);
            } catch (\Exception $e) {
                // Index might already exist
            }

            try {
                $table->index('is_confirmed');
            } catch (\Exception $e) {
                // Index might already exist
            }
        });
    }

    public function down(): void
    {
        Schema::table('booking_section', function (Blueprint $table) {
            $table->dropIndex(['booking_id', 'section_id']);
            $table->dropIndex(['is_confirmed']);
            $table->dropColumn([
                'quantity_reserved',
                'special_instructions',
                'setup_notes',
                'is_confirmed'
            ]);
        });
    }
};
