<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Airport;
use App\Services\AirportService;

class AirportSelector extends Component
{    
    public $departureAirportId = 0;    
    public $arrivalAirportId = 0;
    public $airports = [];   

    public function mount(AirportService $airs)
    {
        $this->airports = $airs->all();
    }

    public function updatedDepartureAirportId($value)
    {
        $this->dispatch('propertyUpdated', ['property' => 'departureAirport', 'value' => $value]);
    }
    
    public function updatedArrivalAirportId($value)
    {
        $this->dispatch('propertyUpdated', ['property' => 'arrivalAirport', 'value' => $value]);
    }
   
    public function render()
    {
        return view('livewire.airport-selector');
    }
}
