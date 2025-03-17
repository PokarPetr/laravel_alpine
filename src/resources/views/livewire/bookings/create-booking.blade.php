<div> 

   <div class="form-container ma">
        <div class="form-header flex-center">
            @if ($flight) 
            <div class="one-half bord ma">
                                   
                    <div class="flex-between">
                        <p class="flight">Departure Airport</p>
                        <p class="flight">{{ $flight['startCity'] . ' ( ' . $flight['startAirport'] . ' )'}}</p>
                    </div>
                    <div class="flex-between">
                        <p class="flight">Arrival Airport</p>
                        <p class="flight">{{ $flight['returnCity'] . ' ( ' . $flight['returnAirport'] . ' )'}}</p>
                    </div>
                    <div class="flex-between">
                        <p class="flight">Departure Date</p>
                        <p class="flight">{{ $flight['startDate'] }}</p>
                    </div>
                    <div class="flex-between">
                        <p class="flight">Passengers</p>
                        <p class="flight">{{ $number }}</p>
                    </div>
                
            </div>
            <div class="one-half bord ma">
                <div class="flex-between">
                    <p class="flight">Price</p>
                    <p class="flight">{{  'EUR ' . $flight['price']}}</p>
                </div>                    
                <div class="flex-between">
                    <p class="flight">Baggage</p>
                    <p class="flight">{{ $flight['baggage'] ? 'Baggage: 23kg + Handbag: 8 kg' : 'Handbag: 8 kg'  }}</p>
                </div>
                <div class="flex-between">
                    <p class="flight">Total Baggage Fee</p>
                    <p class="flight">{{  'EUR ' . $baggage }}</p>
                </div>
                <div class="flex-between">
                    <p class="flight">Total</p>
                    <p class="flight">{{  'EUR ' . $total}}</p>
                </div>
                
            </div>
            @endif
        </div>
        <form class="form-data" wire:submit="save">
            @csrf
            <h2 class="black center">Add Passenger Data</h2>
            @for ($i=0; $i < $number; $i++) 
                <div class="passenger-data ">
                    <div class="name-data grid-two ma">
                        <input type="text" wire:model.blur="passengers.{{ $i }}.firstName" placeholder="First Name" >
                        
                        <input type="text" wire:model.blur="passengers.{{ $i }}.lastName" placeholder="Last Name" >
                        
                        <input type="text"  wire:model.blur="passengers.{{ $i }}.passportNumber" placeholder="Password Number" value="{{ $passengers[$i]['is_passport'] ? $passengers[$i]['passportNumber'] : '' }}">
                        
                        <input type="date"  class="valid" wire:model="passengers.{{ $i }}.validUntil" placeholder="Valid until" >                   
                                                                                
                    </div>
                    @if (in_array($i, $passengersWithErrors))
                        <div class="flex-center error-window">
                            @foreach ([$i . '_firstName', $i . '_lastName', $i . '_passportNumber', $i . '_validUntil'] as $field)
                                @error($field)
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            @endforeach
                        </div>
                    @endif
                    <div class="baggage">
                        
                        {{ $passengers[$i]['baggage'] ? 'Baggage: 23kg + Handbag: 8 kg' : 'Handbag: 8 kg'  }}
                        <p>
                            <label for="baggage-toggle-{{ $i }}" class="baggage-label">Baggage
                            <input type="checkbox" id="baggage-toggle-{{ $i }}" wire:model.live="baggageSelected.{{ $i }}">
                            @error('passengers.' . $i . '.baggage') <span class="error">{{ $message }}</span> @enderror

                            </label>
                      </p>
                    </div>
                </div> 

                @if ( $i != 0 )
                    <button type="button" wire:click="removePassenger({{ $i }})">Get rid of the passenger</button>
                @endif
                <hr>
            @endfor
            
            <div class="center" wire:click="addPassenger">
                <button type="button" >Add Passenger</button>
            </div>               
            <div class="center">
                <button>Submit</button>
            </div>               
        </form>
        
        
   </div>
   
   <style>
    
    .form-container {
        max-width: 100%;
        min-height: 100vh;
        padding: 1rem;
        border-radius: 1rem;
        background-color: white;
        color: black;
    }

    .passenger-data {
        max-width: 100%;
        margin-top: 1rem;
        padding: 1rem;
    }
    .document-type,
    .name-data {
        margin-bottom: 2rem;
    }
    .document-type select {
        min-width: 250px;
    }
    .passenger-data input::placeholder {
        color: white;
    }

    .center {
        text-align: center;
        margin-top: 2rem;
    }
    .flex-center {
        display: flex;
        justify-content: center;
        flex-direction: row;
        gap: 0.5em;
    }
    .flex-between {
        display: flex;
        justify-content: space-between;
        flex-direction: row;        
    }
    .grid-two {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        max-width: 80%;
    }
    .ma {
        margin-inline: auto;
    }
    .bord {
        border: 3px solid black; 
    }
    .one-half {
        width: 50%;
        padding: 1rem;        
    }
    .black {
        color: black;
    }

    .error-window  {
        border: solid 1px red;
        border-radius: 0.25rem;
        min-height: 3rem;
        color: red;
        background-color: #e38080;
        text-align: center;
        align-items: center;
        max-width: 80%;
        margin-inline: auto;
        margin-bottom: 2rem;
        font-weight: 700;
    }
    
   </style>
   
</div>
