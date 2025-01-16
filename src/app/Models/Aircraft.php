<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Flight;


class Aircraft extends Model
{
    protected $table = 'aircrafts';

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
