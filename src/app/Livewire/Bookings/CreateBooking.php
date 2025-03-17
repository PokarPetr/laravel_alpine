<?php

namespace App\Livewire\Bookings;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\Booking;
use Livewire\Component;
use App\Models\BoardingPass;
use App\Models\TicketFlight;
use App\Livewire\Forms\BookingForm;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class CreateBooking extends Component
{
    
    public $number;
    public $flight;
    public $total;
    public $baggage;
    public $baggageSelected = [];
    public $passengerData;
    public $passengers = [];
    protected $listeners = [];
    public $passengersWithErrors = [];

    public function mount() 
    {        
        $this->flight = session('flightData', null);

        if(is_null($this->flight)) return redirect()->route('home');

        $this->number = session('passengerNumber', 1);
        $this->passengerData = Config::get('passenger-data');

        $this->passengerData['baggage'] = $this->flight['baggage'];

        for ($i = 0; $i < $this->number; $i++) {
            $this->passengers[$i] = $this->passengerData;
            $this->baggageSelected[$i] = $this->passengers[$i]['baggage'];
        }       
        $this->total = $this->calculateTotal();
    }

    public function removePassenger($index)
    {        
        if ($this->number > 1) {
            unset($this->passengers[$index]);
            $this->passengers = array_values($this->passengers);
            unset($this->baggageSelected[$index]);
            $this->baggageSelected = array_values($this->baggageSelected);
            $this->number--;
            $this->total = $this->calculateTotal();
        }
    }

    public function addPassenger()
    {
        $this->passengers[$this->number] = $this->passengerData;
        $this->baggageSelected[$this->number] = $this->passengers[$this->number]['baggage'];
        $this->number++; 
        $this->total = $this->calculateTotal();    
    }

    private function calculateBaggage()
    {
        $fee = 0;
        for ($i = 0; $i < $this->number; $i++) {            
            $fee += $this->passengers[$i]['baggage'] * 30;
        }
        return $fee;
    }

    private function calculateTotal()
    {
        $this->baggage = $this->calculateBaggage();
        return $this->flight['price'] * $this->number + $this->baggage;
    }

    public function updatedBaggageSelected($value, $index)
    {
        $this->passengers[$index]['baggage'] = $value;
        $this->total = $this->calculateTotal();
    }

    public function save()
    {      
        $this->passengersWithErrors = [];
        $validationResult = $this->validate();
        if ($validationResult !== true) {
            foreach ($validationResult as $key => $messages) {
                foreach ($messages as $message) {
                    $this->addError($key, $message);
                }
            }
        }else {
            $this->store();
        }  
    }

    private function store()
    {
        // dd($this->passengers, $this->flight, $this->total, $this->baggage);
        return redirect('/')->with('success', 'Thanks, for booking the flight.');
    }

    public function validate($rules = null, $messages = [], $attributes = [])
    {        
        $modifiedErrors = [];
       
        foreach ($this->passengers as $index => $passenger) {
            $rules = Config::get('validation.passengers.rules');
            $messages = Config::get('validation.passengers.messages');
            $validator = Validator::make($passenger, $rules, $messages);
		
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();                
                
                foreach ($errors as $key => $messages) {
                    $modifiedKey = $index . '_' . $key;
                    foreach ($messages as $message) {
                        $modifiedErrors[$modifiedKey][] = $message;
                    }
                }
                $this->passengersWithErrors[] = $index;
            }elseif ((array_search($index, $this->passengersWithErrors)) !== false) {
                unset($this->passengersWithErrors[$index]);
            }
        } 

        if($modifiedErrors) {
            return $modifiedErrors;
        }

        return true;    
    }

    
    public function render()
    {
        return view('livewire.bookings.create-booking', [
            'passengersWithErrors' => $this->passengersWithErrors,
        ]);
    }
}
