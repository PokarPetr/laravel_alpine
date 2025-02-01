
    
<div class="airport-selectors" >
    @error('departureAirportId')
        <div class="error-message" style="color: red;">{{ $message }}</div>
    @enderror
    
    <div class="select">
        <div>Departure airport</div>
        <select wire:model.change="departureAirportId" id="departure" >
            
            <option value="">--</option>
            @foreach($airports as $airport)
                <option value="{{ $airport->id }}">{{ $airport->airport_code.' '.$airport->city}}</option>
            @endforeach
        </select>
    </div>
   

    <div class="select">
        <div>Arrival airport</div>
        <select wire:model.change="arrivalAirportId" id="arrival">
            <option value="">--</option>
            @foreach($airports as $airport)
                <option value="{{ $airport->id }}">{{ $airport->airport_code.' '.$airport->city }}</option>
            @endforeach
        </select>
    </div>
    
    <style>

        div.airport-selectors {
            display: flex;
            justify-content: space-between;
        }
        div.airport-selectors select{
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
        }
    </style>
</div>