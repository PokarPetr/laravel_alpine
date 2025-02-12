<div class="calendar-container"> 
    <div class="calender-header">
        <div class="_flex">
            <select wire:model.change="currentYear" >        
                <option value="{{ $currentYear }}">{{ $currentYear }}</option>
                @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
            <select wire:model.change="currentMonth" >        
                <option value="{{ $currentMonth }}">{{ $currentMonthName }}</option>
                @foreach($months as $key => $month)
                    <option value="{{ $key }}">{{ $month }}</option>
                @endforeach
            </select>
            <div class="calendar-field">
                <button type="button" wire:click="resetDate">OnWayTicket</button>
            </div>
        </div > 
        
    </div>
    <h2>{{ $currentMonthName }}</h2>
    <div class="days">
        @foreach($days as $week)
            <div class="calendar-week">
                @foreach($week as $dayData)                
                        <div class="calendar-day {{ $dayData['meta']['class'] }}"  
                            data-date="{{ $dayData['meta']['data-date'] }}" 
                            wire:click="setDate('{{ $dayData['meta']['data-date'] }}')">
                            {{ $dayData['day'] == '_' ? '' : $dayData['day'] }}
                        </div>                                             
                @endforeach
            </div>
        @endforeach 
        <style>
            div.calendar-container {
                position: absolute;
                width: 400px;
                margin-inline: auto;
                background-color: #3f3f3f;
                padding:5px;
                border-radius: 4px;
            }
            div.calender-header {          
                display: flex;
                justify-content: space-between;
            }

            div._flex {
                display: flex;
            }

            div.days {
                display: grid;
                gap: 5px;
            }

            div.calendar-week {
                display: flex;
                gap: 5px;
                justify-content: space-between;
            }

            div.calendar-day {
                display: flex;
                justify-content: left;
                flex:1;
                aspect-ratio: 1;
                padding-top:10px;
                padding-left:10px;
                background-color: #377791;
                color: #fff;
                border-radius: 5px;
                text-align: center;
                font-size: 24px;
            }

            div.calendar-day:hover {
                /* background-color: #296f7f; */
                transform: scale(1.05);
            }

            div.calendar-day:nth-child(7) {
                color: red;
            }
            div.calendar-day:nth-child(6) {
                color: yellow;
            }

            div.next-month-day {
                background-color: #9fdaed;
            }

            /* Изменяем opacity всех других элементов при наведении на один */
            div.calendar-day:hover {
                opacity: 1;
            }

            div.calendar-day:hover ~ div.calendar-day {
                opacity: 0.8;
            }

            div.calendar-day:hover ~ div.calendar-day:hover {
                opacity: 1;
            }

            div.calendar-day:not(:hover) {
                opacity: 0.8;
            }
        </style>
    </div>

</div>