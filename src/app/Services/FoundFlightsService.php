<?php

namespace App\Services;

use DateTime;
use Exception;
use App\Models\FoundFlight;
use App\Services\TicketService;

class FoundFlightsService
{	
	public $choosenFlight;
	public $tickets;

	public function __construct(TicketService $tickets)
	{
		$this->tickets = $tickets;		
	}

	public function choosenFlights()
	{		
		$this->choosenFlight = session('currentFlightData',[]);
		
		$startDateRaw = $this->choosenFlight['startDate'];
		$startDate = $this->validateDate($startDateRaw);
		if(is_null($startDate)) return [];

		$returnDateRaw = $this->choosenFlight['returnDate'];
		$returnDate = $this->validateDate($returnDateRaw );

		$departureAirport = $this->choosenFlight['departureAirport'];
		$arrivalAirport = $this->choosenFlight['arrivalAirport'];
		if(!$departureAirport || !$arrivalAirport) return [];

		$startFlights = $this->getFlights($departureAirport, $arrivalAirport, $startDate);
		$returnFlights = [];

		if(!is_null($returnDate)) {
			$returnFlights = $this->getFlights($arrivalAirport, $departureAirport, $returnDate);		
		}
		$flights = $this->tickets->formTickets($startFlights, $returnFlights);		
		
		return $flights;
	}

	private function validateDate($dateString)
	{
			if (!$dateString) {
					return null;
			}
			return $this->getDate($dateString);
	}

	private function getDate ($dateString)
	{
		try {
			$date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);

			return $date ? $date->format('Y-m-d') : null;
		} catch (Exception $e) {

			return null;
		}
	}

	private function getFlights($departureAirport, $arrivalAirport, $date)
	{
		$flights = FoundFlight::query()
													->where('departure_airport', $departureAirport)
													->where('arrival_airport', $arrivalAirport)
													->where('departure_date', 'like', $date . '%')
													->get();

		return $flights->toArray();
	}	
}