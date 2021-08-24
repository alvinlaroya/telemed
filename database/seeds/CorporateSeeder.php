<?php

use Illuminate\Database\Seeder;

class CorporateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Lets truncate first
        \DB::table('corporate_accounts')->truncate();

        \DB::table('corporate_accounts')->insert(array(
            ['name' => '24/7 Customer Philippines, Inc.'],
            ['name' => '3m Philippines Incorporated'],
            ['name' => 'A. Soriano Corporation (Andres Soriano Corporation)'],
            ['name' => 'Aboitiz Equity Ventures Inc.'],
            ['name' => 'Aboitizland Inc.'],
            ['name' => 'Accette Insurance Brokers, Inc.'],
            ['name' => 'Activeone Health Inc.'],
            ['name' => 'Aeon Information Technology Support Solutions, Inc. (Tyche Consulting Limited Rohq)'],
            ['name' => 'AIG Travel Assist Inc.'],
            ['name' => 'AIU Insurance Company, Ltd.'],
            ['name' => 'All Asia Air Central, Inc.'],
            ['name' => 'Allianz Pnb Life Insurance, Inc.'],
            ['name' => 'Allianz Worldwide Partners Sas (Allianz Worldwide Care)'],
            ['name' => 'Alphaland Development, Inc.'],
            ['name' => 'Alsi (Ayala Land Sales, Inc.)'],
            ['name' => 'Philippine Airlines'],
            ['name' => 'Singapore Airlines'],
            ['name' => 'CIGNA'],
            ['name' => 'ADB'],
            ['name' => 'DBP'],
            ['name' => 'PLDT'],
            ['name' => 'SGV'],
            ['name' => 'MERALCO'],
            ['name' => 'SSS'],
            ['name' => 'PCSO'],
            ['name' => 'Salesian Society of St. John Bosco'],
            ['name' => 'OSMAK'],
        ));
    }
}
