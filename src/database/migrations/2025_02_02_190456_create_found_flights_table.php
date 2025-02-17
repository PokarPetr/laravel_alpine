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
        Schema::create('found_flights', function (Blueprint $table) {
            $table->id();
            $table->char('departure_airport', length: 3);
            $table->char('arrival_airport', length: 3);
            $table->dateTime('departure_date');
            $table->char('aircompany_code', length: 3);
            $table->decimal('price', 8, 2);
            $table->time('flight_time');
            $table->enum('fare_conditions', ['Economy', 'Comfort', 'Business']);
            $table->timestamps();

            $table->index('departure_airport');
            $table->index('arrival_airport');

            $table->foreign('departure_airport')->references('airport_code')->on('airports')->onDelete('cascade');
            $table->foreign('arrival_airport')->references('airport_code')->on('airports')->onDelete('cascade');
            $table->foreign('aircompany_code')->references('aircompany_code')->on('aircompanies')->onDelete('cascade');
       
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_flights');
    }
};
