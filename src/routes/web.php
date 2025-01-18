<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketFlightController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BoardingPassController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $airports = DB::table('airports')->get();
    $airport_mod = DB::select('SELECT airport_code, airport_name, city, ROUND(ST_Distance(coordinates, (SELECT coordinates FROM airports WHERE airport_code="TGD")) / 1000) as distance_in_meters FROM airports WHERE airport_code!="TGD" ORDER BY distance_in_meters');
   
    return view('welcome', compact('airport_mod'));
});

Route::get('/hello', function () {
    return view('hello');
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
