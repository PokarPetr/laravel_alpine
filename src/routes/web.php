<?php

use App\Livewire\BookingForm;
use App\Livewire\AirportSelector;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AircraftController;

use App\Http\Controllers\Pages\HomeController;
use App\Livewire\Bookings\FlightAvailableList;
use App\Http\Controllers\BoardingPassController;
use App\Http\Controllers\TicketFlightController;
use App\Http\Controllers\Pages\FlightListController;
use App\Http\Controllers\Pages\BookingFormController;

Route::get('/welcome', function () {

    $aircrafts = DB::table('aircrafts')->get();
    $airport_mod = DB::select('SELECT airport_code, airport_name, city, ROUND(ST_Distance(coordinates, (SELECT coordinates FROM airports WHERE airport_code="TGD")) / 1000) as distance_in_meters FROM airports WHERE airport_code!="TGD" ORDER BY distance_in_meters');
    $seats_count = DB::select('SELECT fare_conditions, COUNT(*) as count FROM seats GROUP BY fare_conditions ORDER BY fare_conditions DESC');
    $aircompanies = DB::select('SELECT aircompany_code, name FROM aircompanies');
    $flights = DB::select('SELECT * FROM found_flights');
       
    return view('welcome', compact('airport_mod', 'aircrafts', 'seats_count', 'aircompanies', 'flights'));
});


Route::get('/',[ HomeController::class, 'index'])->name('home');
Route::get('/booking-form',[ BookingFormController::class, 'index'])->name('booking-form');
Route::get('/flight-available-list',[ FlightListController::class, 'index'])->name('flight-available-list');

Route::get('/airport-selector', AirportSelector::class);
Route::get('/calendar', function() {
    return view('pages.calendar', ['title' => 'Calendar']);
});
Route::get('/thanks', function() {
    return view('pages.thanks', ['title' => 'Thanks']);
});




Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashbord']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('bookings', BookingController::class);
Route::resource('tickets', TicketController::class);
Route::resource('ticket_flights', TicketFlightController::class);
Route::resource('boarding_passes', BoardingPassController::class);
Route::resource('aircrafts', AircraftController::class);
Route::resource('airports', AirportController::class);
Route::resource('flights', FlightController::class);
Route::resource('seats', SeatController::class);

require __DIR__.'/auth.php';
