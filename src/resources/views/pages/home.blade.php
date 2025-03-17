@extends('layouts.app')

@section('content')

<!-- {{ now()->format('Y-m-d') }} -->
@if (session('success'))
	<div class="success">	
			<div class="success-message">
					{{ session('success') }}
			</div>	
	</div>
@endif


<h2 style="text-align:center; margin-bottom: 30px;" >Start looking for your flight. </h2>
<style>
	.success {
		max-width: 80%;
		min-height: 5rem;
		text-align: center;
		align-content: center;
		margin-inline: auto;
		color: green;
		font-size: 25px;
		font-weight: 500;
		background-color: #71ab71;
		border: 1px solid green;
		border-radius: 0.25rem;
	}
	
</style>

@livewire('bookings.flight-search-form')
@endsection



