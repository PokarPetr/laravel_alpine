<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $airports = [
            ['airport_code' => 'AMS', 'airport_name' => 'Amsterdam Airport Schiphol', 'city' => 'Amsterdam', 'coordinates' => DB::raw("ST_PointFromText('POINT(52.308 4.7641)', 4326)")],
            ['airport_code' => 'LHR', 'airport_name' => 'London Heathrow Airport', 'city' => 'London', 'coordinates' => DB::raw("ST_PointFromText('POINT(51.889267 0.262703)', 4326)")],
            ['airport_code' => 'CDG', 'airport_name' => 'Charles de Gaulle Airport', 'city' => 'Paris', 'coordinates' => DB::raw("ST_PointFromText('POINT(49.003197 2.5670)', 4326)")],
            ['airport_code' => 'FCO', 'airport_name' => 'Leonardo da Vinci International Airport', 'city' => 'Rome', 'coordinates' => DB::raw("ST_PointFromText('POINT(41.8002 12.2388)', 4326)")],
            ['airport_code' => 'MAD', 'airport_name' => 'Adolfo Suarez Madrid Barajas Airport', 'city' => 'Madrid', 'coordinates' => DB::raw("ST_PointFromText('POINT(40.4719260 -3.5626400)', 4326)")],
            ['airport_code' => 'SVO', 'airport_name' => 'Sheremetyevo International Airport', 'city' => 'Moscow', 'coordinates' => DB::raw("ST_PointFromText('POINT(55.9726 37.4144)', 4326)")],
            ['airport_code' => 'ZRH', 'airport_name' => 'Zurich Airport', 'city' => 'Zurich', 'coordinates' => DB::raw("ST_PointFromText('POINT(47.4500 8.5645)', 4326)")],
            ['airport_code' => 'VIE', 'airport_name' => 'Vienna International Airport', 'city' => 'Vienna', 'coordinates' => DB::raw("ST_PointFromText('POINT(56.600 9.400)', 4326)")],
            ['airport_code' => 'BUD', 'airport_name' => 'Budapest Ferenc Liszt International Airport', 'city' => 'Budapest', 'coordinates' => DB::raw("ST_PointFromText('POINT(4.183 46.467)', 4326)")],
            ['airport_code' => 'OTP', 'airport_name' => 'Henri Coandă International Airport', 'city' => 'Bucharest', 'coordinates' => DB::raw("ST_PointFromText('POINT(44.5711 26.0850)', 4326)")],
            ['airport_code' => 'BEG', 'airport_name' => 'Belgrade Nikola Tesla Airport', 'city' => 'Belgrade', 'coordinates' => DB::raw("ST_PointFromText('POINT(44.8193 20.2909)', 4326)")],
            ['airport_code' => 'SKG', 'airport_name' => 'Thessaloniki Airport', 'city' => 'Thessaloniki', 'coordinates' => DB::raw("ST_PointFromText('POINT(40.5243 22.9770)', 4326)")],
            ['airport_code' => 'SOF', 'airport_name' => 'Sofia Airport', 'city' => 'Sofia', 'coordinates' => DB::raw("ST_PointFromText('POINT(42.6966 23.4025)', 4326)")],
            ['airport_code' => 'TGD', 'airport_name' => 'Podgorica Airport', 'city' => 'Podgorica', 'coordinates' => DB::raw("ST_PointFromText('POINT(42.3597 19.2459)', 4326)")],
            ['airport_code' => 'LJU', 'airport_name' => 'Ljubljana Jože Pučnik Airport', 'city' => 'Ljubljana', 'coordinates' => DB::raw("ST_PointFromText('POINT(46.2233 14.4589)', 4326)")],
            ['airport_code' => 'SKP', 'airport_name' => 'Skopje Alexander the Great Airport', 'city' => 'Skopje', 'coordinates' => DB::raw("ST_PointFromText('POINT(41.9619 21.6214)', 4326)")],
            ['airport_code' => 'PRN', 'airport_name' => 'Pristina International Airport', 'city' => 'Pristina', 'coordinates' => DB::raw("ST_PointFromText('POINT(42.5722 21.02898)', 4326)")],
            ['airport_code' => 'ZAG', 'airport_name' => 'Franjo Tudman Airport', 'city' => 'Zagreb', 'coordinates' => DB::raw("ST_PointFromText('POINT(45.7423 16.08054)', 4326)")],
            ['airport_code' => 'BTS', 'airport_name' => 'M. R. Štefánik Airport', 'city' => 'Bratislava', 'coordinates' => DB::raw("ST_PointFromText('POINT(48.1700 17.1992)', 4326)")],
            ['airport_code' => 'LIS', 'airport_name' => 'Lisbon Humberto Delgado Airport', 'city' => 'Lisbon', 'coordinates' => DB::raw("ST_PointFromText('POINT(-9.1349 38.7696)', 4326)")],
            ['airport_code' => 'ATH', 'airport_name' => 'Eleftherios Venizelos Airport', 'city' => 'Athens', 'coordinates' => DB::raw("ST_PointFromText('POINT(37.9364 23.94514)', 4326)")],
            ['airport_code' => 'OSL', 'airport_name' => 'Oslo Gardermoen Airport', 'city' => 'Oslo', 'coordinates' => DB::raw("ST_PointFromText('POINT(60.1932 11.09881)', 4326)")],
            ['airport_code' => 'STN', 'airport_name' => 'London Stansted Airport', 'city' => 'London', 'coordinates' => DB::raw("ST_PointFromText('POINT(51.8892 0.2684)', 4326)")],
            ['airport_code' => 'PRG', 'airport_name' => 'Václav Havel Airport', 'city' => 'Prague', 'coordinates' => DB::raw("ST_PointFromText('POINT(50.1008 14.27044)', 4326)")],
            ['airport_code' => 'HAM', 'airport_name' => 'Hamburg Airport', 'city' => 'Hamburg', 'coordinates' => DB::raw("ST_PointFromText('POINT(53.6307 10.0065)', 4326)")],
            ['airport_code' => 'KIV', 'airport_name' => 'Chisinau International Airport', 'city' => 'Chisinau', 'coordinates' => DB::raw("ST_PointFromText('POINT(46.9270 28.93481)', 4326)")],
            ['airport_code' => 'BVA', 'airport_name' => 'Beauvais Tille Airport', 'city' => 'Beauvais', 'coordinates' => DB::raw("ST_PointFromText('POINT(49.46053 2.1130)', 4326)")],
            ['airport_code' => 'ARN', 'airport_name' => 'Stockholm Arlanda Airport', 'city' => 'Stockholm', 'coordinates' => DB::raw("ST_PointFromText('POINT(59.6519 17.9186)', 4326)")],
            ['airport_code' => 'CPH', 'airport_name' => 'Copenhagen Airport', 'city' => 'Copenhagen', 'coordinates' => DB::raw("ST_PointFromText('POINT(55.6180 12.6492)', 4326)")],
        ];


        DB::table('airports')->insert($airports);
    }
}
