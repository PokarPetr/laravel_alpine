<?php

namespace App\Livewire;

use Livewire\Component;

class FlightCard extends Component
{

    public $flight;
    public $baggageSelected = false;

    public function mount($flight)
    {
        $this->flight = $flight;
    }
    
    public function updatedBaggageSelected($value)
    {
        $this->baggageSelected = $value ? true : false;
        $addFee = $value ? 30 : 0;
        $this->flight['total'] = $this->flight['price'] + $addFee;        
        $this->flight['baggage'] = $value ? true : false;
        $this->flight['baggageFee'] = $value ? 30 : 0;
    }

    public function render()
    {
        return view('livewire.flight-card');
    }
}
