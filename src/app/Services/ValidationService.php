<?php

namespace App\Services;


use Illuminate\Support\Facades\Validator;

class ValidationService
{
	
	public function validate(array $data, array $rules, array $messages)
	{
		$validator = Validator::make($data, $rules, $messages);
		
        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
	}
}