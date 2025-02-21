<?php

namespace App\Services;

use App\Models\FoundFlight;
use App\Models\Aircompany;
use App\Services\GetDistanceService;

class CreateFakeFlightService
{
	protected $data;
	private $distance;

	public function __construct(GetDistanceService $dist)
	{
		$this->distance = $dist;
	}

	public function createFakeFlight($flightData)
	{
		$distance = $this->distance->setFlightData($flightData);			
		$flightTime = $this->calculateFlightTime($distance);
		$ticketsData = [
				['coefficient' => 0.1, 'fare_condition' => 'Economy'], 
				['coefficient' => 0.15, 'fare_condition' => 'Comfort']
		]; 
		foreach($ticketsData as $ticketData) { 
			$airCompanyCode = Aircompany::inRandomOrder()->first()->aircompany_code;		
			$price = $distance * $ticketData['coefficient'];
			$data = $this->formFlightData($flightData['departureAirport'],$flightData['arrivalAirport'], $flightData['startDate'],$airCompanyCode, $flightTime, $price,	$ticketData['fare_condition']);
			$this->create($data);

			if($flightData['returnDate']) {
				$data = $this->formFlightData($flightData['arrivalAirport'], $flightData['departureAirport'],$flightData['returnDate'],$airCompanyCode, $flightTime, $price,	$ticketData['fare_condition']);
				$this->create($data);
			}	
		}
	}

	private function formFlightData($depAirport, $arrAirport, $date, $company, $time, $price, $condition)
	{
		return [
			'departure_airport' => $depAirport,
			'arrival_airport' => $arrAirport,
			'departure_date' => $date,
			'aircompany_code' => $company,
			'flight_time' => $time,
			'price' => $price,
			'fare_conditions' => $condition
		];
	}

	private function create($data)
	{
		return FoundFlight::create($data);
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