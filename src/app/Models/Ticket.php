<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function ticketFlights()
    {
        return $this->hasMany(TicketFlight::class);
    }
}
