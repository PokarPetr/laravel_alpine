<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundFlight extends Model
{
    use HasFactory;

    protected $table = 'found_flights';

    protected $fillable = [
        'departure_airport', 
        'arrival_airport', 
        'departure_date', 
        'return_date', 
        'number_passengers', 
        'aircompany_code',
        'flight_time',
        'price', 
        'total'
    ];

    public function aircompany()
    {
        return $this->belongsTo(Aircompany::class, 'aircompany_code', 'aircompany_code');
    }

    
}
