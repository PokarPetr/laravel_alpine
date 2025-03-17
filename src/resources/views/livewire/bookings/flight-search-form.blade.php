<div>
    <!-- <ul>
        <p>DepartureAirport => {{ $currentFlightData['departureAirport'] }}</p>
        <p>ArrivalAirport => {{ $currentFlightData['arrivalAirport'] }}</p>
        <p>DepartureDate => {{ $currentFlightData['startDate'] }}</p>
        <p>ArrivalDate => {{ $currentFlightData['returnDate'] }}</p>
        <p>Passengers => {{ $currentFlightData['passengerNumber'] }}</p>
    </ul> -->      
  <form class="flightsearchform" wire:submit.prevent="searchFlights" >
        @csrf
        
       <div> @livewire('airport-selector' ) </div>       
        
        <div>@livewire('departure-date')</div>
        
        <div>@livewire('passenger-count')</div>

        <button type="submit">Find Flights!</button>
    </form> 
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  
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
        .alert {
            display: flex;
            flex-direction: row;
            justify-content: center;
            flex-wrap: nowrap;
        }
        .alert-danger ul{
            list-style: none;
        }
        .alert-danger ul li {
            color: red;
            padding-inline: 2em;
            padding-block: 0.75em;
            background-color:#f8938e;
        }

    </style>
</div>