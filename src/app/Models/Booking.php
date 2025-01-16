<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
