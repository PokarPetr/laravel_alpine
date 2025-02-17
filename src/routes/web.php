<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\BoardingPassController;
use App\Http\Controllers\TicketFlightController;

use App\Livewire\BookingForm;
use App\Livewire\AirportSelector;
use App\Livewire\Bookings\FlightAvailableList;

Route::get('/', function () {

    $aircrafts = DB::table('aircrafts')->get();
    $airport_mod = DB::select('SELECT airport_code, airport_name, city, ROUND(ST_Distance(coordinates, (SELECT coordinates FROM airports WHERE airport_code="TGD")) / 1000) as distance_in_meters FROM airports WHERE airport_code!="TGD" ORDER BY distance_in_meters');
    $seats_count = DB::select('SELECT fare_conditions, COUNT(*) as count FROM seats GROUP BY fare_conditions ORDER BY fare_conditions DESC');
       
    return view('welcome', compact('airport_mod', 'aircrafts', 'seats_count'));
});


Route::get('/home', function () {
    if (View::exists('pages.home')){
        return View::make('pages.home', ['title' => 'BookingHomePage']);
    }
    return abort(404, 'Home page not found');
})->name('home');

Route::get('/flight-available-list', function() {
    return view('pages.flight-available-list', ['title' => 'Available Flights']);
})->name('flight-available-list');


Route::get('/airport-selector', AirportSelector::class);
Route::get('/calendar', function() {
    return view('pages.calendar', ['title' => 'Calendar']);
});



Route::get('/dashboard', function () {
    return view('dashboard');
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
