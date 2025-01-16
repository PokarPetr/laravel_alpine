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
        Schema::create('tickets', function (Blueprint $table) {
            $table->char('book_ref', length: 6);
            $table->char('passenger_id', length: 20);
            $table->char('ticket_no', length: 13)->primary();
            $table->text('passenger_name');
            $table->jsonb('contact_data')->nullable();
            $table->timestamps();
            $table->foreign('book_ref')->references('book_ref')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
