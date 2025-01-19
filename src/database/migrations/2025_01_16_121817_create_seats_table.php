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
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->varchar('aircraft_code', length: 6);
            $table->string('seat_no', length: 4); 
            $table->enum('fare_conditions', ['Economy', 'Comfort', 'Business']);
            $table->timestamps();

            $table->foreign('aircraft_code')->references('aircraft_code')->on('aircrafts')->onDelete('cascade');

            $table->unique(['aircraft_code', 'seat_no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
