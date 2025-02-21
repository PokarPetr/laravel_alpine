
<div>    
    <div class="airport-selectors" >       
        
        <div class="select">
            <div>Departure airport</div>            
            <select wire:model.change="departureAirportId">                
                <option value="{{ session('departureAirportId', '') }}">{{ session('departureAirport', '--') }}</option>
                @foreach($airports as $airport)
                    <option value="{{ $airport->id }}">{{ $airport->airport_code.' '.$airport->city}}</option>
                @endforeach
            </select>
        </div>    

        <div class="select">
            <div>Arrival airport</div>
            <select wire:model.change="arrivalAirportId">
                <option value="{{ session('arrivalAirportId', '') }}">{{ session('arrivalAirport', '--') }}</option>
                @foreach($airports as $airport)
                    <option value="{{ $airport->id }}">{{ $airport->airport_code.' '.$airport->city }}</option>
                @endforeach
            </select>
        </div> 

    </div>
    <style>
        div.airport-selectors {
            display: flex;
            justify-content: space-between;
        }
        div.airport-selectors select{
            max-width: 180px;
            max-height: 50px;
            color: #000;
            background-color: #fff;
        }
        div.select div {
            color: #000;
        }
        
        .error-message {
            position:absolute;
            font-size: 1.05em;
            top: 10px;
        }
    </style>
</div>