<div>
    <div class="date-container">
        <div data-test-id="start-date-field">
            <label >Departure date</label>
            <input class="open-calendar" type="text" wire:model="startDate" readonly
            wire:click="openCalendar('start')" placeholder="--">    
            
        </div>
        <div class="return-date" data-test-id="return-date-field">
        <label >Return date</label>
            <input class="open-calendar" type="text" wire:model="returnDate" readonly
            wire:click="openCalendar('return')" placeholder="--">        
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
            max-width: 180px;
            background-color: #fff;
            color: #000;
        }

        div.date-container input::placeholder{           
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
