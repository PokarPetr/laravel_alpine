<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundFlight extends Model
{
    use HasFactory;

    protected $table = 'found_flights';

    protected $attributes = [
        'departure_airport' => '', 
        'arrival_airport' => '', 
        'departure_date' => '',
        'aircompany_code' => '',
        'flight_time' => '',
        'price' => '0', 
        'fare_conditions' => 'Economy'
    ];

    protected $fillable = [
        'departure_airport', 
        'arrival_airport', 
        'departure_date',
        'aircompany_code',
        'flight_time',
        'price', 
        'fare_conditions'
    ];

    public function aircompany()
    {
        return $this->belongsTo(Aircompany::class, 'aircompany_code', 'aircompany_code');
    }

    
}
