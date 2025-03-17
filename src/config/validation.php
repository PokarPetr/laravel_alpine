<?php

return [
	'flights' => [
		'rules' => [
			'departureAirport' => ['required', 'size:3' ],
			'arrivalAirport' => ['required', 'size:3', 'different:departureAirport'],
			'startDate' => ['required', 'date'],
			'returnDate' => ['date'],
			'passengerNumber' => ['required', 'integer', 'min:1'],
		],
		'messages' => [
			'departureAirport.required' => 'Departure Airport is required',
			'departureAirport.size' => 'Departure Airport must exactly 3 characters long',
			'arrivalAirport.required' => 'Arrival Airport is required',
			'arrivalAirport.size' => 'Arrival Airport must be exactly 3 characters long',
			'arrivalAirport.different' => 'Airports must be different',
			'startDate.required' => 'Departure Date is required',
			'startDate.date' => 'Departure Date must be a valid date',
			'returnDate.date' => 'Return Date must be a valid date',
			'passengerNumber.required' => 'Number of Passengers is required',
			'passengerNumber.integer' => 'Number of Passengers must be an integer',
			'passengerNumber.min' => 'Number of Passengers must be at least 1',
		],
	],
	'passengers' => [
		'rules' => [
			"firstName" => 'required|string|min:2|max:50',
			"lastName" => 'required|string|min:2|max:50',
			"thirdName" => 'nullable|string|max:25',
			"passportNumber" => 'required|string',
			"validUntil" => 'required|date',
	],
		'messages' => [
			'firstName.string' => 'First name must be a valid string.',
			'firstName.required' => 'First name is required.',
			'firstName.min' => 'First name must be at least 2 characters long.',
			'firstName.max' => 'First name cannot be longer than 50 characters.',
			
			'lastName.required' => 'Last name is required.',
			'lastName.string' => 'Last name must be a valid string.',
			'lastName.min' => 'Last name must be at least 5 characters long.',
			'lastName.max' => 'Last name cannot be longer than 50 characters.',
			
			'thirdName.string' => 'Third name must be a valid string.',
			'thirdName.max' => 'Third name cannot be longer than 25 characters.',
			
			'passportNumber.required' => 'Passport number is required when the passenger has a passport.',
			'passportNumber.string' => 'Passport number must be a valid string.',
			
			'idNumber.required' => 'ID number is required when the passenger does not have a passport.',
			'idNumber.string' => 'ID number must be a valid string.',
			
			'validUntil.required' => 'Valid until date is required.',
			'validUntil.date' => 'Valid until must be a valid date.',
		]
	]

];