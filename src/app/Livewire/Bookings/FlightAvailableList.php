<?php

namespace App\Livewire\Bookings;

use Livewire\Component;
use App\Services\FoundFlightsService;
use App\Services\AircompanyService;
use Illuminate\Support\Facades\DB;

class FlightAvailableList extends Component
{
    public $ticket;
    public $flights;
    public $startDate;
    public $returnDate;
    public $openCard = false;
    public $baggageSelected = [];
    protected $listeners = ['closeFlightCard' => 'closeFlightCard'];

    public function mount(FoundFlightsService $flights, AircompanyService $aircompanies)
    {
        $this->flights = $flights->choosenFlights();
        for ($index=0; $index < count($this->flights); $index++){
            $this->baggageSelected[$index] = false;
            $this->totalPrice($index , $this->baggageSelected[$index]);
        }
        
    }

    public function openFlightCard($index)
    {
        $this->openCard = true;
        $this->choosenTicket($index);
    }

    private function choosenTicket($index)
    {
        $this->ticket = $this->flights[$index]; 
    }
    
    public function closeFlightCard()
    {
        $this->openCard = false; 
        $this->ticket = null;
    }

    public function updatedBaggageSelected($value, $index)
    {
        $this->totalPrice($index, $value);             
    }

    private function totalPrice($index, $baggage)
    {
        if ($baggage){
            $this->flights[$index]['total'] = $this->flights[$index]['price'] + 30;
            $this->flights[$index]['baggage'] = true;
        } else {
            $this->flights[$index]['total'] = $this->flights[$index]['price'];
            $this->flights[$index]['baggage'] = false;
        }
    }
    
    public function render()
    {
        return view('livewire.bookings.flight-available-list');
    }
}
