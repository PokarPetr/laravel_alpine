<div>
    <h2 style="text-align:center; margin-bottom: 30px;" >Booking Form</h2>
    <form class="flightsearchform" wire:submit="save">
        @csrf

        @livewire('airport-selector')        
        
        @livewire('departure-date')

        
        @livewire('passenger-count')
        <button type="submit">Find Flights</button>
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
