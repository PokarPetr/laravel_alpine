<div><div class="result-container">
      @if(!$openCard)
       @livewire('bookings.flight-search-form')
      @endif  
      @foreach($flights as $index => $flight)
      @if( is_array($flight))
        <div class="results">
            <div class="ticket-preview {{ $openCard ? 'muted' : '' }}">
                  <div class="left-side">
                        <p class="ticket-price" >Price {{ $flight['price'] }}</p> 
                        <p>
                              <label for="baggage-toggle-{{ $index }}" class="baggage-label">Add baggage(+30 EUR)
                              <input type="checkbox" id="baggage-toggle-{{ $index }}" wire:model.live="baggageSelected.{{ $index }}">
                              </label>
                        </p>
                        <p class="ticket-price" >Total {{ $flight['total'] }}</p>
                        <a href="#flights-start" class="flights-start">    
                              <button class="button" wire:click="openFlightCard({{  $index  }})">Choose</button>
                        </a>
                  </div>
                  <div class="right-side">
                        <div>
                              <span> {{ $flight['startAircompany'] }}</span><span class="return-aircompany"> {{ $flight['returnAircompany'] }}</span>
                        </div>
                        <div class="ticket-info">
                              <div class="ticket-time">
                                    <p class="flight-time">{{ $flight['startTime'] }}</p>
                                    <p class="flight-addition">{{ $flight['startCity'] }}</p>
                                    <p class="flight-addition">{{ $flight['startDate'] }}</p>
                              </div>
                              <div class="ticket-travel"> 
                                    <p class="travel-time" >Travel Time {{ $flight['startTravel'] }}</p>
                                    <hr>
                                    <p class="travel-icons" ><span>{{ $flight['startAirport'] }}</span><span> => </span><span>{{ $flight['returnAirport'] }}</span></p>
                              </div>
                              <div class="ticket-time">
                                    <p class="flight-time">{{ $flight['startArrivalTime'] }}</p>
                                    <p class="flight-addition">{{ $flight['returnCity'] }}</p>
                                    <p class="flight-addition">{{ $flight['startArrivalDate'] }}</p>
                              </div>
                        </div>
                        @if($flight['returnTicket'])                              
                        <div class="ticket-info">
                              <div class="ticket-time">
                                    <p class="flight-time">{{ $flight['returnTime'] }}</p>
                                    <p class="flight-addition">{{ $flight['returnCity'] }}</p>
                                    <p class="flight-addition">{{ $flight['returnDate'] }}</p>
                              </div>
                              <div class="ticket-travel"> 
                                    <p class="travel-time" >Travel Time {{ $flight['returnTravel'] }}</p>
                                    <hr>
                                    <p class="travel-icons" ><span>{{ $flight['returnAirport'] }}</span><span> => </span><span>{{ $flight['startAirport'] }}</span></p>
                              </div>
                              <div class="ticket-time">
                                    <p class="flight-time">{{ $flight['returnArrivalTime'] }}</p>
                                    <p class="flight-addition">{{ $flight['startCity'] }}</p>
                                    <p class="flight-addition">{{ $flight['returnArrivalDate'] }}</p>
                              </div>
                        </div>
                        @endif
                  </div>
            </div>            
        </div>
      @endif  
   @endforeach 
   @if($openCard)
      <div class="card">
            @livewire('flight-card', ['flight' => $ticket])
      </div>
      @endif
   <style>
      .result-container {
            position: relative;
      }
      .results {
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
      }
      .ticket-preview {
            display: flex;
            justify-content: center;
            margin: 0.5rem;
            padding: 0;
            background-color: white;            
            border-radius: 0.5em;
      }
      .left-side {
            display: flex;
            flex-direction: column;
            width: 250px;
            padding: 1rem;
            color: black;            
      }
      .ticket-price {
            flex: 1;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
      }
      .left-side .button {
            margin-inline: auto;
            margin-bottom: 50px;
            padding-inline: 2em;
            padding-block: 0.75em;
      }
      .right-side{
            flex: 1;
            padding: 1rem;
            color: black;
      }
      .return-aircompany {
            margin-left: 30px;
      }
      .ticket-info {
            display: flex;
            padding-right: 1rem;
      }
      .ticket-travel {
            padding-inline: 1em;
            flex: 1;
      }
      .ticket-time {
            padding-inline: 0;
      }
      .flight-time {
            font-size: 35px;
            margin: 0;
      }
      .flight-addition {
            margin: 0;
      }
      .travel-icons {
            display: flex;
            justify-content: space-evenly;
      }
      .travel-time {
            text-align: center;
      }
      .muted {
            opacity: 0.3;
      }
      .card {
            position: absolute;
            top: 0;
            width:100%;
            height: 100vh;
      }
      a.flights-start {
            text-decoration: none;
            text-align: center;
      }
      .baggage-label {
            display: flex;
            align-items: center;
            cursor: pointer;
      }
   </style>  
   <script>
            let sessionFlightData = @json(session('currentFlightData'));
            console.log(sessionFlightData); 
            
   </script>
   </div>
</div>
