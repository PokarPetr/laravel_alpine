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
    protected $listeners = ['closeFlightCard' => 'closeFlightCard'];

    public function mount(FoundFlightsService $flights, AircompanyService $aircompanies)
    {
        $this->flights = $flights->choosenFlights();       
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
    
    public function render()
    {
        return view('livewire.bookings.flight-available-list');
    }
}
