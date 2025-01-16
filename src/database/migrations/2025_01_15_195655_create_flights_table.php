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
        Schema::create('flights', function (Blueprint $table) {
            $table->id('flight_id');
            $table->char('flight_no', length: 6);
            $table->timestampTz('scheduled_departure');
            $table->timestampTz('scheduled_arrival');
            $table->char('departure_airport', length: 3);
            $table->char('arrival_airport', length: 3);                       
            $table->enum('status', ['On Time', 'Delayed', 'Departed', 'Arrived', 'Scheduled', 'Cancelled']);
            $table->char('aircraft_code', length: 3);
            $table->timestampTz('actual_departure')->nullable();
            $table->timestampTz('actual_arrival')->nullable();
            $table->foreign('aircraft_code')->references('aircraft_code')->on('aircrafts')->onDelete('cascade');
            $table->foreign('arrival_airport')->references('airport_code')->on('airports')->onDelete('cascade');
            $table->foreign('departure_airport')->references('airport_code')->on('airports')->onDelete('cascade');
            $table->unique(['flight_no', 'scheduled_departure']);
           
        });
        DB::statement('ALTER TABLE flights ADD CONSTRAINT scheduled_status_check CHECK (scheduled_arrival > scheduled_departure)');
        DB::statement('ALTER TABLE flights ADD CONSTRAINT actual_status_check CHECK (actual_arrival IS NULL OR (actual_arrival IS NOT NULL AND actual_departure IS NOT NULL AND actual_arrival > actual_departure))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
