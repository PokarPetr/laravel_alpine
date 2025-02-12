<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Seeder;

class AircompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $aircompany_map = [
            ['aircompany_code' =>'AUA', 'name' => 'Austrian Airlines', 'created_at' => now(), 'updated_at' => now()],
            ['aircompany_code' =>'BAW', 'name' => 'British Airways', 'created_at' => now(), 'updated_at' => now()],
            ['aircompany_code' =>'JAF', 'name' => 'Jetairfly', 'created_at' => now(), 'updated_at' => now()],
            ['aircompany_code' =>'CTN', 'name' => 'Croatia Airlines', 'created_at' => now(), 'updated_at' => now()],
            ['aircompany_code' =>'LOT', 'name' => 'LOT Polish Airlines', 'created_at' => now(), 'updated_at' => now()],
            ['aircompany_code' =>'PGT', 'name' => 'Pegasus Airlines', 'created_at' => now(), 'updated_at' => now()],
            ['aircompany_code' =>'RYR', 'name' => 'Ryanair', 'created_at' => now(), 'updated_at' => now()],
            ['aircompany_code' =>'BTI', 'name' => 'AirBaltic', 'created_at' => now(), 'updated_at' => now()],
            ['aircompany_code' =>'THY', 'name' => 'Turkish Airlines', 'created_at' => now(), 'updated_at' => now()],
            
        ];
        DB::table('aircompanies')->insertOrIgnore($aircompany_map);
    }
}
