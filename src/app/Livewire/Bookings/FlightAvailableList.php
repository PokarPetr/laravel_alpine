<?php

namespace App\Livewire\Bookings;

use Livewire\Component;
use App\Services\FoundFlightsService;
use App\Services\AircompanyService;
use Illuminate\Support\Facades\DB;

class FlightAvailableList extends Component
{
    public $flights;
    public $startDate;
    public $returnDate;
    public $currentFlight;

    public function mount(FoundFlightsService $flights, AircompanyService $aircompanies)
    {
        $this->currentFlight = session('currentFlightData',[]);
        $this->flights = $flights->choosenFlights();       
    }
    
    public function render()
    {
        return view('livewire.bookings.flight-available-list');
    }
}
