<?php

namespace App\Livewire\Bookings;

use Carbon\Carbon;

use ReflectionClass;
use App\Models\Airport;
use Livewire\Component;
use App\Models\FoundFlight;
use App\Services\AirportService;
use Illuminate\Support\Facades\Config;
use App\Services\CreateFakeFlightService;
use App\Services\ValidationService;
use Livewire\Features\SupportRedirects\Redirector;



class FlightSearchForm extends Component
{
    public $airports;
    public $flightData;    
    public $currentFlightData;
    public $messages;

    protected $listeners = [
        'propertyUpdated' => 'addPropertyToForm',
    ];
    
    public function mount(AirportService $airs)
    { 
        $this->airports = $airs::all();

        $this->flightData= [
            'departureAirport' => 'airportCode',
            'arrivalAirport' => 'airportCode',
            'startDate' => 'flightDateTime',
            'returnDate' => 'flightDateTime',
            'passengerNumber' => 'passengerNumber',            
        ];
        $this->currentFlightData = [
            'departureAirportId' => session('departureAirportId', ''),
            'departureAirport' => session('departureAirport', ''),
            'arrivalAirportId' => session('arrivalAirportId', ''),
            'arrivalAirport' => session('arrivalAirport', ''),
            'startDate' => session('startDate', ''),
            'returnDate' => session('returnDate', ''),
            'passengerNumber' => session('passengerNumber', 1),  
        ];
                   
    }
    
    public function addPropertyToForm($data): void
    {         
        if (isset($data['property'])) {
            $method = $this->flightData[$data['property']];
            $this->currentFlightData[$data['property']] = $this->$method($data);
            session([$data['property'] => $this->currentFlightData[$data['property']]], 120);
        }
    }

    public function airportCode($airportData): string
    {
        if($airportData['value'] == '') return '';
        $airportId = $airportData['property'] . 'Id';
        $this->currentFlightData[$airportId] = $airportData['value'];
        session([$airportId => $airportData['value']], 120);
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

    public function passengerNumber($passengerNumberData): int
    {
        if (isset($passengerNumberData['property'])){
            return $passengerNumberData['value'];
        }
        return 1;        
    }
    
    public function searchFlights(ValidationService $validation, CreateFakeFlightService $fakeFlight): Redirector|null
    {  
        $rules = Config::get('validation.flights.rules');
        $messages = Config::get('validation.flights.messages');
        $validationResult = $validation->validate($this->currentFlightData, $rules, $messages);

        if ($validationResult !== true) {
            foreach ($validationResult->getMessages() as $key => $messages) {
                foreach ($messages as $message) {
                    $this->addError($key, $message);
                }
            }
            return null;
        }
       
        $fakeFlight->createFakeFlight($this->currentFlightData);
        session(['currentFlightData' => $this->currentFlightData]);
        session(['passengerNumber' => $this->currentFlightData['passengerNumber']]);
        return redirect()->route('flight-available-list');
    }

    public function render()
    {
        return view('livewire.bookings.flight-search-form');
    }
}
