<?php

namespace App\View\Components\Bookings;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Airport;

class FlightSearchForm extends Component
{
    public $airports;
    public $departureDates;
    public $returnDates;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->airports = Airport::all();
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bookings.flight-search-form');
    }
}
