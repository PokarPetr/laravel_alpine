@extends('layouts.app')

@section('content')
@livewire('bookings.flight-search-form')

<h1 style="text-align:center;">Flights</h1>

<div class="flights-list">
	@livewire('bookings.flight-available-list')	
</div>

@endsection
