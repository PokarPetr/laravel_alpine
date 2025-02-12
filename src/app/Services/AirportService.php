<?php

namespace App\Services;

use App\Models\Airport;

class AirportService
{
	public function all()
	{
		return Airport::all();
	}

}