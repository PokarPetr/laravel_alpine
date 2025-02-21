<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class GetDistanceService
{
    public $flightData;
   
	public function setFlightData($data)
	{			
        $this->flightData = $data;
        return $this->calculateDistance();
	}

	private function calculateDistance(): float
    {
        if ($this->flightData['departureAirport'] && $this->flightData['arrivalAirport']) 
        {
            $departureCoordinates = $this->getAirportCoordinates($this->flightData['departureAirport']);
            $arrivalCoordinates = $this->getAirportCoordinates($this->flightData['arrivalAirport']);

            

            $departureLat = $departureCoordinates->latitude;
            $departureLng = $departureCoordinates->longitude;
        
            $arrivalLat = $arrivalCoordinates->latitude;
            $arrivalLng = $arrivalCoordinates->longitude;
        
            return $this->haversine($departureLat, $departureLng, $arrivalLat, $arrivalLng);
                
        } else {
            
            return 1000.00;
        }
    }

    private function getAirportCoordinates($airportCode)
    {
        return DB::table('airports')
                ->selectRaw('ST_Y(coordinates) AS longitude, ST_X(coordinates) AS latitude')
                ->where('airport_code', $airportCode)
                ->first();
    }

    private function haversine($lat1, $lng1, $lat2, $lng2): float
    {
        $earthRadius = 6371;
       
        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);
        
        $dLat = $lat2 - $lat1;
        $dLng = $lng2 - $lng1;
        
        $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1) * cos($lat2) * sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        
        return round($earthRadius * $c);
    }
}