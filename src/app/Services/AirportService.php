<?php

namespace App\Services;

use App\Models\Airport;

class AirportService
{
	static public function all()
	{
		return Airport::all();
	}

}