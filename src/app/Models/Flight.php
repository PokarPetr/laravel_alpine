<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function airports()
    {
        return $this->belongsToMany(Airport::class);
    }
}
