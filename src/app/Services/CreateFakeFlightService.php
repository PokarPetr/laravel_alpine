<?php

namespace App\Services;

use App\Models\FoundFlight;
use App\Models\Aircompany;

class CreateFakeFlightService
{
	protected $data;

	public function createFakeFlight($flightData, $distance, $coeff)
	{

		$airCompanyCode = Aircompany::inRandomOrder()->first()->aircompany_code;
		
		$flightTime = $this->calculateFlightTime($distance);
		$data = [
			'departure_airport' => $flightData['departureAirport'],
			'arrival_airport' => $flightData['arrivalAirport'],
			'departure_date' => $flightData['startDate'],
			'return_date' => $flightData['returnDate'],
			'number_passengers' => $flightData['passangerNumber'],
			'aircompany_code' => $airCompanyCode,
			'flight_time' => $flightTime,
			'price' => $distance * $coeff,
			'total' => $distance * $coeff * $flightData['passangerNumber'],
		];

		$foundFlight = FoundFlight::create($data);		
	}

	private function calculateFlightTime($distance)
	{			
			$speed = 850;
			
			$timeInHours = $distance / $speed;
			if ($timeInHours < 1) {
        return '01:00:00';
   		}
	
			$hours = floor($timeInHours);
			$minutes = round(($timeInHours - $hours) * 60);

			$roundedMinutes = $this->roundToNearestQuarter($minutes);

			return sprintf('%02d:%02d:00', $hours, $roundedMinutes);
	}

	private function roundToNearestQuarter($minutes)
	{
			$quarters = [0, 15, 30, 45];
			
			$diff = array_map(function($quarter) use ($minutes) {
					return abs($minutes - $quarter);
			}, $quarters);
			
			return $quarters[array_search(min($diff), $diff)];
	}
}