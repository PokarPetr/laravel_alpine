<?php

namespace App\Livewire\Bookings;

use Livewire\Component;
use App\Models\FoundFlight;
use Illuminate\Support\Facades\DB;

class FlightAvailableList extends Component
{
    public $flights;

    public function mount()
    {
        $this->flights = FoundFlight::all();
    }

    public function render()
    {
        return view('livewire.bookings.flight-available-list');
    }
}
