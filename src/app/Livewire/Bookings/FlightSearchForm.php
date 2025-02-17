<?php

namespace App\Livewire\Bookings;

use ReflectionClass;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Airport;
use App\Models\FoundFlight;
use App\Services\AirportService;
use App\Services\CreateFakeFlightService;
use Livewire\Features\SupportRedirects\Redirector;

class FlightSearchForm extends Component
{
    public $airports;
    public $flightData;
    public $currentFlightData;

    protected $listeners = [
        'propertyUpdated' => 'addPropertyToForm',
    ];
    
    public function mount(AirportService $airs)
    { 
        $this->airports = $airs->all(); 

        $this->flightData= [
            'departureAirport' => 'airportCode',
            'arrivalAirport' => 'airportCode',
            'startDate' => 'flightDateTime',
            'returnDate' => 'flightDateTime',
            'passangerNumber' => 'passangerNumber',            
        ];
        $this->currentFlightData = [
            'departureAirport' => '',
            'arrivalAirport' => '',
            'startDate' => '',
            'returnDate' => '',
            'passangerNumber' => 1, 
        ];       
    }
    
    public function addPropertyToForm($data): void
    {         
        if (isset($data['property'])) {
            $method = $this->flightData[$data['property']];
            $this->currentFlightData[$data['property']] = $this->$method($data);            
        }
    }

    public function airportCode($airportData): string
    {
        if($airportData['value'] == '') return '';
        return $this->airports->firstWhere('id', $airportData['value'])->airport_code;
    }

    public function flightDateTime($flightDateData)
    {
        
        if (isset($flightDateData['property'])){
            if($flightDateData['property'] == 'startDate'){

                return Carbon::parse($flightDateData['value'].' 10:00:00');

            }elseif($flightDateData['property'] == 'returnDate' && $flightDateData['value']){

                return Carbon::parse($flightDateData['value'].' 18:00:00');
            } 
        }
        return '';        
    }

    public function passangerNumber($passangerNumberData): int
    {
        if (isset($passangerNumberData['property'])){
            return $passangerNumberData['value'];
        }
        return 1;        
    }
    
    public function searchFlights(CreateFakeFlightService $fakeFlight): Redirector
    {        
        $fakeFlight->createFakeFlight($this->currentFlightData);
        session(['currentFlightData' => $this->currentFlightData]);
        return redirect()->route('flight-available-list'); 
    }

    public function render()
    {
        return view('livewire.bookings.flight-search-form');
    }
}
