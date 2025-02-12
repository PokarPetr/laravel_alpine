<?php

namespace App\Models;

use App\Models\FoundFlight;
use Illuminate\Database\Eloquent\Model;

class Aircompany extends Model
{
    protected $table = 'aircompanies';

    protected $fillable = [
        'aircompany_code',
        'name',
    ];

    public function foundFlight()
    {
        return $this->hasMany(FoundFlight::class, 'aircompany_code', 'aircompany_code');
    }
}
