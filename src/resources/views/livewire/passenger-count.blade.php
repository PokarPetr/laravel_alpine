<div>
    <div class="date-container">
            <div data-test-id="start-date-field">
                <label for="passenger_number">Number of Passenger</label>
                <input class="open-counter" type="text" wire:model="passengerNumber" readonly
                wire:click="openCounter()"  id="passenger_number"> 
            </div>            
    </div>
    @if($showCounter)
        <div class="calendar-popup "> 
            <div class="counter-container">
                <div class="counter-header">
                    <div class="counter-field">
                        <button type="button" wire:click="resetReturnDate">BackToSingle</button>
                    </div>
                </div>
                <h1>{{ $passengerNumber }}</h1>            
                <button type="button" wire:click="increment">+</button>            
                <button type="button" wire:click="decrement">-</button>            
            </div>
        </div>
    @endif

        <style>
        .open-counter{
            max-width: 180px;
        }
        div.counter-container {
                    position: absolute;
                    width: 250px;
                    margin-inline: auto;
                    background-color: #3f3f3f;
                    padding:5px;
                    border-radius: 4px;
                }
        div.counter-container h1 {
            color: #fff;
        }
        div.date-container {
                display: flex;
            }
        div.counter-header {
                display: flex;
            }
    </style>
</div>
