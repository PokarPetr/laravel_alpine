@extends('layouts.app')

@section('content')

{{ now()->format('Y-m-d') }}

<h1 style="text-align:center;">Calendar</h1>
@livewire('calendar-selector')

@endsection