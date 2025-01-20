<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class AircraftsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aircrafts = [
            ['aircraft_code' => 'A320', 'model' => 'Airbus A320', 'range' => 6300],
            ['aircraft_code' => 'B737', 'model' => 'Boeing 737', 'range' => 6570],
            ['aircraft_code' => 'A350', 'model' => 'Airbus A350', 'range' => 18000],
            ['aircraft_code' => 'B787', 'model' => 'Boeing 787', 'range' => 14800],
            ['aircraft_code' => 'A380', 'model' => 'Airbus A380', 'range' => 15200],
            ['aircraft_code' => 'B777', 'model' => 'Boeing 777', 'range' => 15300],
            ['aircraft_code' => 'A330', 'model' => 'Airbus A330', 'range' => 13450],
            ['aircraft_code' => 'B767', 'model' => 'Boeing 767', 'range' => 11830],
            ['aircraft_code' => 'E195', 'model' => 'Embraer E195', 'range' => 4500],
            ['aircraft_code' => 'CRJ900', 'model' => 'Bombardier CRJ900', 'range' => 2950],
        ];

        // DB::table('aircrafts')->truncate();  
        DB::table('aircrafts')->insert($aircrafts);
    }
}
