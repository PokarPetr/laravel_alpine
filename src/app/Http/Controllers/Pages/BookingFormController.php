<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingFormController extends Controller
{
    public function index() 
    {
        $title = 'Booking Form';       

        return view('pages.booking-form', compact('title'));
    }
}
