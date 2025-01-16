<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketFlight extends Model
{
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
