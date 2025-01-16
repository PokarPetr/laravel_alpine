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
        Schema::create('ticket_flights', function (Blueprint $table) {
            $table->char('ticket_no', length: 13);
            $table->unsignedBigInteger('flight_id')->unique();
            $table->enum('fare_conditions', ['Economy', 'Comfort', 'Business']);
            $table->decimal('amount', total: 10, places: 2);
            $table->timestamps();
            $table->foreign('flight_id')->references('flight_id')->on('flights')->onDelete('cascade');
            $table->foreign('ticket_no')->references('ticket_no')->on('tickets')->onDelete('cascade');
            $table->primary(['ticket_no', 'flight_id']);
        });
        DB::statement('ALTER TABLE ticket_flights ADD CONSTRAINT check_amount CHECK (amount >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_flights');
    }
};
