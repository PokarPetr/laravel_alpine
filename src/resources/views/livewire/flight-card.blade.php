<div class="flight-card-modal">
    <div class="back-to-tickets">
        <button class="back-to-tickets-button" wire:click="$dispatch('closeFlightCard')">Back to Tickets</button>
    </div>
    

    <div class="ticket-details">
        <h3>Flight from {{ $flight['startCity'] . ' (' . $flight['startAirport'] . ')  to ' . $flight['returnCity'] . ' (' . $flight['returnAirport'] . ') '}}</h3>
        <div class="date-grid">
            <div class="date-grid-item"><p>Start Date:</p> <p>{{ $flight['startDate'] }}</p></div>
            <div class="date-grid-item"><p>Start Time:</p> <p>{{ $flight['startTime'] }}</p></div>
            <div class="date-grid-item"><p>{{ $flight['returnDate'] ? "Return Date:" : "" }}</p> <p>{{ $flight['returnDate'] }}</p></div>
            <div class="date-grid-item"><p>{{ $flight['returnTime'] ? "Return Time:" : "" }}</p> <p>{{ $flight['returnTime'] }}</p></div>
            <p><strong>Flight Time:</strong> {{ $flight['startTravel'] }}</p>
            <p><strong>Number of passengers:</strong> {{ $number }}</p>
        </div>
       
        <h3>{{ $flight['returnAircompany'] ? 'Aircompanies: ' . $flight['startAircompany'] . ' - ' . $flight['returnAircompany']  :  'Aircompany: ' . $flight['startAircompany'] }} </h3>
        
       <div class="date-drid">
        <div class="date-grid-item">
            <p>Price: {{ $flight['price'] }}</p>
            <p>Total: {{ $flight['total'] }}</p>
        </div>
       </div>
        

        
       
               
        {{-- <div class="baggage-section">
            @for($i = 1; $i <= $number; $i++)
                <p>
                    <label for="baggage-toggle" class="baggage-label">Add baggage for passanger {{ $i }} (+30 EUR)
                    <input type="checkbox" id="baggage-toggle" wire:model.live="baggageSelected">
                    <span class="slider"></span>
                    </label>
                </p>
            @endfor
            <p><strong>Baggage Fee: </strong><span>{{ $baggageSelected ? 30 : 0 }}</span></p>
        </div> --}}

        
        {{-- <p><strong>Total Price: </strong>{{ $baggageSelected ? $flight['total'] : $flight['price'] }}</p> --}}

        
         <div class="go-ahead">
            <button class="go-ahead-button" wire:click="goAhead">Go Ahead</button>
         </div>        
    </div>

    <style>
        .flight-card-modal {
            padding: 20px;
            background-color: #fff;
            border-radius: 0.5em;
            max-width: 70%;
            margin: auto;
        }
        .flight-card-modal h3,
        .flight-card-modal p strong,
        .baggage-section p strong,
        .flight-card-modal label {
            color: black;
            font-size: 25px;
            font-weight: 700;
        }
        .flight-card-modal p,
        .baggage-section p {
            color: black;
            font-size: 25px;
            font-weight: 400;
        }
        .back-to-tickets,
        .go-ahead {
            width: fit-content;
            margin-left: auto;
        }
        .back-to-tickets-button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: auto;
        }

        .go-ahead-button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            margin-left: auto;
        }

        .ticket-details {
            margin-top: 20px;
            text-align: center;
        }
        .date-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .date-grid-item {
            display: flex;
            justify-content: center;
        }
        .date-grid-item p {
            min-width: 150px;
            font-weight: 700;
            margin-block: 0.25rem;
            text-align: end;
        }
        .baggage-section {
            margin-top: 20px;
            color: black;
        }

        .baggage-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .slider {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
            margin-left: 10px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: 0.4s;
        }

        input:checked + .slider:before {
            transform: translateX(14px);
        }

        input:checked + .slider {
            background-color: #4CAF50;
        }
    </style>

    <script>
        Livewire.on('closeFlightCard', () => {
            @this.set('openCard', false);
        });
    </script>
</div>

