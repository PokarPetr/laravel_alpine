@extends('layouts.app')

@section('content')

{{ now()->format('Y-m-d') }}

<h1 style="text-align:center;">Home</h1>

<x-bookings.flight-search-form />
@endsection
