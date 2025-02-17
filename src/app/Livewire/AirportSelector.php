<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Airport;
use App\Services\AirportService;

class AirportSelector extends Component
{
    public $departureAirportId = null;
    public $arrivalAirportId = null;
    public $airports = [];


    protected $rules = [
        'departureAirportId' => 'nullable|exists:airports,id',
        'arrivalAirportId' => 'nullable|exists:airports,id',
    ];
  

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
    
    public function updated($propertyName)
    {
        if ($this->departureAirportId && $this->arrivalAirportId && $this->departureAirportId == $this->arrivalAirportId) {
            $this->addError('departureAirportId', 'Departure and arrival airports cannot be the same.');
        } else {
            $this->resetValidation();
        }
        
    }

    public function render()
    {
        return view('livewire.airport-selector');
    }
}
