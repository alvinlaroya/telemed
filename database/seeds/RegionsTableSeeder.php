<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('regions')->delete();
        
        \DB::table('regions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => '010000000',
            'name' => 'Region I (Ilocos Region)',
                'region_id' => '01',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => '020000000',
            'name' => 'Region II (Cagayan Valley)',
                'region_id' => '02',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => '030000000',
            'name' => 'Region III (Central Luzon)',
                'region_id' => '03',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => '040000000',
            'name' => 'Region IV-A (CALABARZON)',
                'region_id' => '04',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => '170000000',
                'name' => 'MIMAROPA Region',
                'region_id' => '17',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => '050000000',
            'name' => 'Region V (Bicol Region)',
                'region_id' => '05',
            ),
            6 => 
            array (
                'id' => 7,
                'code' => '060000000',
            'name' => 'Region VI (Western Visayas)',
                'region_id' => '06',
            ),
            7 => 
            array (
                'id' => 8,
                'code' => '070000000',
            'name' => 'Region VII (Central Visayas)',
                'region_id' => '07',
            ),
            8 => 
            array (
                'id' => 9,
                'code' => '080000000',
            'name' => 'Region VIII (Eastern Visayas)',
                'region_id' => '08',
            ),
            9 => 
            array (
                'id' => 10,
                'code' => '090000000',
            'name' => 'Region IX (Zamboanga Peninsula)',
                'region_id' => '09',
            ),
            10 => 
            array (
                'id' => 11,
                'code' => '100000000',
            'name' => 'Region X (Northern Mindanao)',
                'region_id' => '10',
            ),
            11 => 
            array (
                'id' => 12,
                'code' => '110000000',
            'name' => 'Region XI (Davao Region)',
                'region_id' => '11',
            ),
            12 => 
            array (
                'id' => 13,
                'code' => '120000000',
            'name' => 'Region XII (SOCCSKSARGEN)',
                'region_id' => '12',
            ),
            13 => 
            array (
                'id' => 14,
                'code' => '130000000',
            'name' => 'National Capital Region (NCR)',
                'region_id' => '13',
            ),
            14 => 
            array (
                'id' => 15,
                'code' => '140000000',
            'name' => 'Cordillera Administrative Region (CAR)',
                'region_id' => '14',
            ),
            15 => 
            array (
                'id' => 16,
                'code' => '150000000',
            'name' => 'Autonomous Region In Muslim Mindanao (ARMM)',
                'region_id' => '15',
            ),
            16 => 
            array (
                'id' => 17,
                'code' => '160000000',
            'name' => 'Region XIII (Caraga)',
                'region_id' => '16',
            ),
        ));
        
        
    }
}