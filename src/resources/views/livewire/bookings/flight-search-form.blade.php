<div>
    <h2 style="text-align:center; margin-bottom: 30px;" >Booking Form</h2>
    <form class="flightsearchform" wire:submit.prevent="searchFlights" >
        @csrf

       <div> @livewire('airport-selector') </div>       
        
        <div>@livewire('departure-date')</div>
        
        <div>@livewire('passenger-count')</div>

        <button type="submit">Find Flights!</button>
    </form>
    <div wire:loading> 
        Saving post...
    </div>
    <style>
        form.flightsearchform {
            display:flex; 
            justify-content:space-between; 
            background-color: #fff; 
            padding: 15px; 
            border-radius: 4px;
            gap: 7px;
        }
        form.flightsearchform label,
        form.flightsearchform p
        {
            color: #000;
        }

    </style>
</div>