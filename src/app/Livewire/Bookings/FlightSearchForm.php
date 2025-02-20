<?php

namespace App\Livewire\Bookings;

use ReflectionClass;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Airport;
use App\Models\FoundFlight;
use Illuminate\Http\Request;
use App\Services\AirportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
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
            'departureAirport' => '',
            'arrivalAirport' => '',
            'startDate' => '',
            'returnDate' => '',
            'passangerNumber' => 1, 
        ];
        $this->messages = [
        ['currentFlightData.departureAirport.required' => 'Departure Airport is required',
        'currentFlightData.departureAirport.min' => 'Departure Airport must be at least 3 characters long'],
        
        ['currentFlightData.arrivalAirport.required' => 'Arrival Airport is required',
        'currentFlightData.arrivalAirport.min' => 'Arrival Airport must be at least 3 characters long'],
        
        ['currentFlightData.startDate.required' => 'Departure Date is required',
        'currentFlightData.startDate.date' => 'Departure Date must be a valid date'],
        
        ['currentFlightData.passangerNumber.required' => 'Number of Passengers is required',
        'currentFlightData.passangerNumber.integer' => 'Number of Passengers must be an integer',
        'currentFlightData.passangerNumber.min' => 'Number of Passengers must be at least 1'],
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
    
    public function searchFlights(FlightValidationService $validation, CreateFakeFlightService $fakeFlight, Request $request): Redirector|null
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
