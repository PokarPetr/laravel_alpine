<?php

namespace App\Services;

use DateTime;
use DateInterval;
use Exception;
use App\Services\AirportService;
use App\Services\AircompanyService;

class TicketService
{
	public $tickets;
	public $airports;
	public $aircompanies;
	public function __construct(AircompanyService $aircompanies, AirportService $airports,)
	{
		$this->airports = $airports->all();
		$this->aircompanies = $aircompanies->all();
	}

	public function formTickets($directs, $returns)
	{
		$tickets = [];
		
		foreach($directs as $direct){
			$ticket = [];
			$ticket['returnTicket'] = false;
			$ticket['startCity'] = $this->getCity($direct['departure_airport']);
			$ticket['startAirport'] = $direct['departure_airport'];
			$ticket['returnCity'] = $this->getCity($direct['arrival_airport']);
			$ticket['returnAirport'] = $direct['arrival_airport'];
			$ticket['startDate'] = $this->getDate($direct['departure_date']);
			$ticket['returnDate'] = '';
			$ticket['startTime'] = $this->getDate($direct['departure_date'], true);
			$ticket['returnTime'] = '';
			$ticket['price'] = $direct['price'];
			$ticket['startAircompany'] = $this->getAircompanyName($direct['aircompany_code']);
			$ticket['returnAircompany'] = '';
			$ticket['startTravel'] = $direct['flight_time'];
			$ticket['startArrivalDate'] = $this->getDate($direct['departure_date'], false, $direct['flight_time']);
			$ticket['startArrivalTime'] = $this->getDate($direct['departure_date'], true, $direct['flight_time']);
			$ticket['returnTravel'] = '';
			$ticket['returnArrivalDate'] = '';
			$ticket['returnArrivalTime'] = '';
			$ticket['startConditions'] = $direct['fare_conditions'];
			$ticket['returnConditions'] = '';

			if($returns){
				foreach($returns as $return){
					$ticket['returnTicket'] = true;
					$ticket['returnDate'] = $this->getDate($return['departure_date']);
					$ticket['returnTime'] = $this->getDate($return['departure_date'], true);
					$ticket['price'] = $ticket['price'] + $return['price'];
					$ticket['returnAircompany'] = $direct['aircompany_code'] == $return['aircompany_code'] ? '' : $this->getAircompanyName($return['aircompany_code']);
					$ticket['returnTravel'] = $return['flight_time'];
					$ticket['returnArrivalDate'] = $this->getDate($return['departure_date'], false, $return['flight_time']);
					$ticket['returnArrivalTime'] = $this->getDate($return['departure_date'], true, $return['flight_time']);
					$ticket['returnConditions'] = $return['fare_conditions'];
					$tickets[] = $ticket;
				}
			}else{
				$tickets[] = $ticket;
			}
		}
		return $tickets;
	}

	private function getAircompanyName($code){
		return $this->aircompanies->where('aircompany_code', $code)->first()->name;
	}

	private function getCity($code){
		return $this->airports->where('airport_code', $code)->first()->city;
	}

	private function getDate($datetime, $time=false, $interval=false)
	{
		try {
			$date = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
			if($interval){
				list($hours, $minutes, $seconds) = explode(':', $interval);
				$delta = new DateInterval('PT' . $hours . 'H' . $minutes . 'M' . $seconds . 'S');
				$date->add($delta);
			}
			if($time){
				return $date ? $date->format('H:i') : null;
			}
			return $date ? $date->format('Y-m-d') : null;
		} catch (Exception $e) {
			return null;
		}
	}
}