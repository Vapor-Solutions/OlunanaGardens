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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('MerchantRequestID')->unique()->nullable();
            $table->string('CheckoutRequestID')->unique()->nullable();
            $table->string('status')->nullable(); // requested, success, failed
            $table->string('resultDesc')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->date('transactionDate')->nullable();
            $table->foreignId('payment_method_id')->constrained()->onUpdate('cascade');
            $table->foreignId('booking_id')->constrained();
            $table->unsignedDecimal('amount', 15, 2);
            $table->string('reference_code')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};