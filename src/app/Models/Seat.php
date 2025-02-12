<?php

namespace App\Models;

use App\Models\Aircraft;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    
    public function aircraft()
    {
        return $this->belongsTo(Aircraft::class, 'aircraft_code', 'aircraft_code');
    }
}
