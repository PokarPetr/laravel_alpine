@extends('layouts.app')

@section('content')

<!-- {{ now()->format('Y-m-d') }} -->

<h2 style="text-align:center; margin-bottom: 30px;" >Booking Form</h2>

@livewire('bookings.flight-search-form')
@endsection


