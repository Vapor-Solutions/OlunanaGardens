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
        Schema::create('food_class_package', function (Blueprint $table) {
            $table->foreignId('food_class_id')->constrained();
            $table->foreignId('package_id')->constrained();
            $table->primary(['food_class_id', 'package_id']);
            $table->unsignedBigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_class_package');
    }
};
