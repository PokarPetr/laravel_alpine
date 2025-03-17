<?php

namespace App\Livewire;

use Livewire\Component;

class FlightCard extends Component
{

    public $flight;
    public $number;

    public function mount($flight)
    {
        $this->flight = $flight;
        $this->number = session('passengerNumber', 1);
    } 

    public function goAhead()
    {        
        session(['flightData' => $this->flight]);
        
        return redirect()->route('booking-form');
    }

    public function render()
    {
        return view('livewire.flight-card');
    }
}
