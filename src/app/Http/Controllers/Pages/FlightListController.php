<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class FlightListController extends Controller
{
    public function index() {
        $title = "Available Flights";
        
        return view('pages.flight-available-list', compact('title'));
    }
}
