<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class SeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seats = [];
        $aircraft_map = $this->getAircraftConfig();
            
        foreach ($aircraft_map as $model => $config) {            
            $this->formSeats($seats, $model, $config);  
        }        

        DB::table('seats')->truncate();       
        DB::table('seats')->insert($seats);           
    }

    /**
     * Returns the aircraft configuration.
     */
    private function getAircraftConfig(): array
    {
        return [
            'A320'=> [
                'business_letters' => ['A', 'C', 'D', 'F'],
                'econom_letters' => ['A', 'B', 'C', 'D', 'E', 'F'],
                'last_business_row' => 5,
                'last_row' => 25,
                'special_rows' => [                    
                    10 =>[
                        'Economy' => ['A', 'F'],
                        'Comfort' => ['B', 'C', 'D', 'E'],
                        ],
                ]
            ],
            'A330' => [
                'business_letters' => ['A', 'C', 'D', 'G', 'H', 'K'],
                'econom_letters' => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'K'],
                'last_business_row' => 6,
                'last_row' => 45,
                'special_rows' => [ 
                    6 => ['Business' => ['A', 'C', 'H', 'K'], ],                   
                    7 => ['Economy' => [], ],                   
                    8 => ['Economy' => [], ],                   
                    9 => ['Economy' => [], ],                   
                    10 => ['Economy' => [], ],                   
                    29  => ['Economy' => ['D', 'E', 'F', 'G'], 'Comfort' => ['A', 'C', 'H', 'K'] ],
                    42 => ['Economy' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],
                    43 => ['Economy' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],
                    44 => ['Economy' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],
                    45 => ['Economy' => ['D', 'E', 'F'],],
                                                              
                ]
            ],
            'A380' => [
                'business_letters' => ['A', 'C', 'D', 'G', 'H', 'K'],
                'econom_letters' => ['A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K'],
                'last_business_row' => 8,
                'last_row' => 42,
                'special_rows' => [                        
                    9 => ['Economy' => [], ],                   
                    10 => ['Economy' => [], ],                   
                    11 => ['Economy' => [], ],                   
                    12 => ['Comfort' => ['A', 'C', 'D', 'E', 'G', 'H', 'K'],],
                    13 => ['Economy' => [], ], 
                    14 => ['Comfort' => ['A', 'C', 'D', 'E', 'G', 'H', 'K'],],
                    15 => ['Comfort' => ['A', 'C', 'D', 'E', 'G', 'H', 'K'],],                    
                    16 => ['Economy' => ['A', 'B', 'D', 'E', 'G', 'J', 'K'],],
                    27 => ['Economy' => ['B', 'C', 'D', 'E', 'G', 'H', 'J'],],
                    45 => ['Economy' => ['D', 'E', 'G'],],                                                              
                ]
            ],
            'B737' => [
                'business_letters' => ['A', 'C', 'D', 'F'],
                'econom_letters' => ['A', 'B', 'C', 'D', 'E', 'F'],
                'last_business_row' => 5,
                'last_row' => 25,
                'special_rows' => [                    
                    13 =>[
                        'Economy' => ['A', 'F'],
                        'Comfort' => ['B', 'C', 'D', 'E'],
                        ],
                ],
            ],
            'B767' => [
                'business_letters' => ['A', 'B', 'C', 'F', 'G', 'H'],
                'econom_letters' => ['A', 'B', 'C', 'D', 'E', 'F'],
                'last_business_row' => 5,
                'last_row' => 39,
                'special_rows' => [ 
                    6 => ['Economy' => [], ],                   
                    7 => ['Economy' => [], ],                   
                    8 => ['Economy' => [], ],                   
                    9  => ['Economy' => ['A', 'B', 'G', 'H'], ],
                    25 => ['Economy' => ['D', 'E', 'F'],],
                    26 => ['Economy' => [], ],
                    27 => ['Comfort' => ['A', 'B', 'C', 'D', 'E', 'F'],],
                    39 => ['Economy' => ['D', 'E', 'F'],],                                           
                ]
            ],
            'B777' => [
                'business_letters' => ['A', 'C', 'D', 'G', 'H', 'K'],
                'econom_letters' => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K'],
                'last_business_row' => 5,
                'last_row' => 51,
                'special_rows' => [ 
                    11 => ['Comfort' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],                                           
                    12 => ['Comfort' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],                                           
                    13 => ['Comfort' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],                                           
                    14 => ['Comfort' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],                                           
                    15 => ['Comfort' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],                                           
                    16 => ['Comfort' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],                                           
                ],
            ],        
            'B787' => [
                'business_letters' => ['A', 'C', 'D', 'G', 'H', 'K'],
                'econom_letters' => ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'J', 'K'],
                'last_business_row' => 11,
                'last_row' => 42,
                'special_rows' => [ 
                    12 => ['Economy' => [],],                                         
                    13 => ['Economy' => [],],                                         
                    14 => ['Economy' => [],],
                    15 => ['Comfort' => ['A', 'C', 'D', 'F', 'G', 'H', 'K'],],                                           
                    16 => ['Comfort' => ['A', 'C', 'D', 'E', 'F', 'H', 'K'],],                                           
                    17 => ['Economy' => [],],                                         
                    18 => ['Economy' => [],],                                         
                    19 => ['Economy' => [],],                                         
                    28 => ['Economy' => ['A', 'B', 'C', 'H', 'J', 'K'],],                                           
                    41 => ['Economy' => ['D', 'F', 'G', ],],                                           
                    42 => ['Economy' => ['D', 'F', 'G', ],],                                           
                                                              
                ],
            ],
            'CRJ900'=> [
                'business_letters' => ['A', 'C', 'D', 'F'],
                'econom_letters' => ['A', 'C', 'D', 'F'],
                'last_business_row' => 6,
                'last_row' => 25,
                'special_rows' => [                    
                    1 =>['Business' => ['A', 'C'],],
                ]
            ],         
            'E195'=> [
                'business_letters' => ['A', 'D', 'F'],
                'econom_letters' => ['A', 'C', 'D', 'F'],
                'last_business_row' => 4,
                'last_row' => 24,
                'special_rows' => []                
            ],         
        ];
    }

     /**
     * Forms the seats for the given aircraft model and configuration.
     *
     * @param array $seats The array to which the seats will be added
     * @param string $model The aircraft model
     * @param array $config The seat configuration for the aircraft
     */
    private function formSeats(array &$seats, string $model, array $config): void
    {
        for ($row = 1; $row <= $config['last_row']; $row++) {
            $fare_conditions = 'Economy';
            $letters = $config['econom_letters'];
            if( $row <= $config['last_business_row'] ) {
                $fare_conditions = 'Business';
                $letters = $config['business_letters'];
            }
            if(array_key_exists($row, $config['special_rows'])){

                foreach( $config['special_rows'][$row] as $fare_conditions => $letters) {
                    if (!empty($letters)) {
                        // Call generateSeats to add the special seats
                        $this->generateSeats($seats, $model, $row, $letters, $fare_conditions);
                    }
                }                
            } else {
                $this->generateSeats($seats, $model, $row, $letters, $fare_conditions);
            }           
        }
    }

     /**
     * Generates the seats based on the row, letters, and fare condition.
     *
     * @param array $seats The array to which the seats will be added
     * @param string $model The aircraft model
     * @param int $row The row number
     * @param array $letters The seat letters for the row
     * @param string $fare_conditions The fare conditions (Business, Economy, Comfort)
     */
    private function generateSeats(array &$seats, string $model, int $row, array $letters, string $fare_conditions): void 
    {
        foreach ($letters as $letter) {
            $seats[] = ['aircraft_code' => $model, 'seat_no' => $row.$letter, 'fare_conditions' => $fare_conditions];
        }
    }
}
