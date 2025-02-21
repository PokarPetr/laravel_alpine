<?php

namespace App\Livewire\Bookings;

use ReflectionClass;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Airport;
use App\Models\FoundFlight;
use App\Services\AirportService;
use App\Services\CreateFakeFlightService;
use App\Services\FlightValidationService;
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
            'passangerNumber' => 'passangerNumber',            
        ];
        $this->currentFlightData = [
            'departureAirportId' => session('departureAirportId', ''),
            'departureAirport' => session('departureAirport', ''),
            'arrivalAirportId' => session('arrivalAirportId', ''),
            'arrivalAirport' => session('arrivalAirport', ''),
            'startDate' => session('startDate', ''),
            'returnDate' => session('returnDate', ''),
            'passangerNumber' => session('passangerNumber', 1),  
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

    public function passangerNumber($passangerNumberData): int
    {
        if (isset($passangerNumberData['property'])){
            return $passangerNumberData['value'];
        }
        return 1;        
    }
    
    public function searchFlights(FlightValidationService $validation, CreateFakeFlightService $fakeFlight): Redirector|null
    {  
        $validationResult = $validation->validate($this->currentFlightData);

        if ($validationResult !== true) {
            foreach ($validationResult->getMessages() as $key => $messages) {
                foreach ($messages as $message) {
                    $this->addError($key, $message);
                }
            }
            return null;
        }
       
        $fakeFlight->createFakeFlight($this->currentFlightData);
        session(['currentFlightData' => $this->currentFlightData], 120);
        return redirect()->route('flight-available-list');
    }

    public function render()
    {
        return view('livewire.bookings.flight-search-form');
    }
}
