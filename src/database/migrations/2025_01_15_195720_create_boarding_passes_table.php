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
        Schema::create('boarding_passes', function (Blueprint $table) {
            $table->char('ticket_no', length: 13);
            $table->unsignedBigInteger('flight_id');
            $table->unsignedInteger('boarding_no');
            $table->string('seat_no', length: 4);
            $table->timestamps();

            $table->primary(['ticket_no', 'flight_id']);
            $table->unique(['flight_id', 'boarding_no']);
            $table->unique(['flight_id', 'seat_no']);

            $table->foreign(['ticket_no', 'flight_id'])->references(['ticket_no', 'flight_id'])->on('ticket_flights')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_passes');
    }
};
