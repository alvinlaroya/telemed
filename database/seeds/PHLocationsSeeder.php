<?php

use Illuminate\Database\Seeder;

class PHLocationsSeeder extends Seeder
{

    public function run()
    {
        $this->call(RegionsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(BarangaysTableSeeder::class);
    }
}
