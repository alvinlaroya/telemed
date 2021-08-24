<?php

use Illuminate\Database\Seeder;

class OrderHomeVisitSeeder extends Seeder
{
    
    public function run()
    {
        $this->call(PackagesTableSeeder::class);
    }

}
