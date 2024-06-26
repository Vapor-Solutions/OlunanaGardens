<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_request_id')->unique()->nullable();
            $table->foreignId('event_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('package_id')->constrained()->onUpdate('cascade');
            $table->foreignId('client_id')->constrained();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->bigInteger('capacity_adults');
            $table->bigInteger('capacity_children');
            $table->unsignedDecimal('price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
