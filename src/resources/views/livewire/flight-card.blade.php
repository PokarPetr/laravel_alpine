<div class="flight-card-modal">
    <div class="back-to-tickets">
        <button class="back-to-tickets-button" wire:click="$dispatch('closeFlightCard')">Back to Tickets</button>
    </div>
    

    <div class="ticket-details">
        <h3>Flight from {{ $flight['startCity'] }} to {{ $flight['returnCity'] }}</h3>
        <p><strong>Price:</strong> {{ $flight['price'] }} </p>
        <p><strong>Start Time:</strong> {{ $flight['startTime'] }}</p>
        <p><strong>{{ $flight['returnTime'] ? "Return Time:" : "" }}</strong> {{ $flight['returnTime'] }}</p>

        
        <p><strong>Aircompany:</strong> {{ $flight['startAircompany'] }}{{ $flight['returnAircompany'] ? " - " . $flight['returnAircompany'] : ""}}</p>
        <p><strong>Flight Time:</strong> {{ $flight['startTravel'] }}</p>
        <p><strong>Airport:</strong> {{ $flight['startAirport'] . " " . "=>" . " " . $flight['returnAirport'] }}</p>

        
        <div class="baggage-section">
            <label for="baggage-toggle" class="baggage-label">
                Add Baggage (+30)
                <input type="checkbox" id="baggage-toggle" wire:model.live="baggageSelected">
                <span class="slider"></span>
            </label>
            <p><strong>Baggage Fee: </strong><span>{{ $baggageSelected ? 30 : 0 }}</span></p>
        </div>

        
        <p><strong>Total Price: </strong>{{ $baggageSelected ? $flight['total'] : $flight['price'] }}</p>

        
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

