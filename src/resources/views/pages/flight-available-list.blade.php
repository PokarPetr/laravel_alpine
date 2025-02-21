@extends('layouts.app')

@section('content')
<h1 id="flights-start" style="text-align:center;">Flights</h1>

<div class="flights-list">
	@livewire('bookings.flight-available-list')
	
</div>

@endsection
