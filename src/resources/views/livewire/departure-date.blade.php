<div>
    <div class="date-container">
        <div data-test-id="start-date-field">
            <label >Departure date</label>
            <input type="text" wire:model="startDate" readonly data-test-id="start-date-value"
            wire:click="openCalendar('start')" placeholder="--">    
            
        </div>
        <div class="return-date" data-test-id="return-date-field">
        <label >Return date</label>
            <input type="text" wire:model="returnDate" readonly data-test-id="return-date-value"
            wire:click="openCalendar('return')" placeholder="--">
        @if($showCalendar)
            <div class="_flex">
                <div class="calendar-field">
                    <button type="button" wire:click="closeCalendar">x</button>
                </div>
                <div class="calendar-field">
                    <button type="button" wire:click="resetReturnDate">Reset</button>
                </div>
            </div>
        @endif
        </div>
    </div>
    @if($showCalendar)
    <div class="calendar-popup "> 
        @livewire('calendar-selector')
    </div>
    @endif
    <style>
        div.date-container {
            display: flex;
        }
        div.date-container input{
            background-color: #fff;
            color: #000;
        }
        div.return-date {
            position: relative;
        }
        
        div.calender-header button{
            padding: 0.75em;
            background-color: #fff;
            color: #000;
        }
    </style>
</div>
