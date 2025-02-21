<div>
    <!-- <ul>
        <p>DepartureAirport => {{ $currentFlightData['departureAirport'] }}</p>
        <p>ArrivalAirport => {{ $currentFlightData['arrivalAirport'] }}</p>
        <p>DepartureDate => {{ $currentFlightData['startDate'] }}</p>
        <p>ArrivalDate => {{ $currentFlightData['returnDate'] }}</p>
        <p>Passangers => {{ $currentFlightData['passangerNumber'] }}</p>
    </ul> -->      
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form class="flightsearchform" wire:submit.prevent="searchFlights" >
        @csrf
        
       <div> @livewire('airport-selector' ) </div>       
        
        <div>@livewire('departure-date')</div>
        
        <div>@livewire('passenger-count')</div>

        <button type="submit">Find Flights!</button>
    </form>   
    <style>
        form.flightsearchform {
            display: grid; 
            grid-auto-flow: column;
            grid-template-columns: 400px 400px 200px 180px;
            width: 1200px;
            margin-inline: auto;
            background-color: #fff; 
            padding-inline: 15px; 
            padding-block: 10px;
            border-radius: 4px;
            gap: 7px;
        }
        form.flightsearchform label,
        form.flightsearchform p {
            color: #000;
        }

        form.flightsearchform button {
            margin-bottom: 0;
        }

    </style>
</div>