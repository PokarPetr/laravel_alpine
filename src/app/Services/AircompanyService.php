<?php

namespace App\Services;

use App\Models\Aircompany;

class AircompanyService
{
	public function all()
	{
		return Aircompany::all();
	}	
}