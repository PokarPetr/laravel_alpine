<?php

namespace App\Services;


use Illuminate\Support\Facades\Validator;

class FlightValidationService
{
	
	public function validate(array $data)
	{
		
		$rules = [
			'departureAirport' => ['required', 'min:3', 'max:3' ],
			'arrivalAirport' => ['required', 'min:3', 'max:3', 'different:departureAirport'],
			'startDate' => ['required', 'date'],
			'returnDate' => ['date'],
			'passangerNumber' => ['required', 'integer', 'min:1'],
		];

		$messages = [
			'departureAirport.required' => 'Departure Airport is required',
			'departureAirport.min' => 'Departure Airport must exactly 3 characters long',
			'departureAirport.max' => 'Departure Airport must exactly 3 characters long',
			'arrivalAirport.required' => 'Arrival Airport is required',
			'arrivalAirport.min' => 'Arrival Airport must be exactly 3 characters long',
			'arrivalAirport.max' => 'Arrival Airport must be exactly 3 characters long',
			'arrivalAirport.different' => 'Airports must be different',
			'startDate.required' => 'Departure Date is required',
			'startDate.date' => 'Departure Date must be a valid date',
			'returnDate.date' => 'Return Date must be a valid date',
			'passangerNumber.required' => 'Number of Passengers is required',
			'passangerNumber.integer' => 'Number of Passengers must be an integer',
			'passangerNumber.min' => 'Number of Passengers must be at least 1',
		];

		$validator = Validator::make($data, $rules, $messages);
		
        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
	}
}