<?php

use Illuminate\Database\Seeder;

class HMOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lets truncate first
       \DB::table('hmo_accreditations')->truncate();

       \DB::table('hmo_accreditations')->insert(array(
            ['name' => 'Advanced Medical Access Philippines, Inc.  (AMAPHIL)'],
            ['name' => 'Avega Managed Care, Inc.'],
            ['name' => 'Beneficial Life Insurance Co., Inc. (Formerly Star Healthcare Systems, Inc.)'],
            ['name' => 'Carehealth Plus Systems International, Inc.'],
            ['name' => 'Caritas Health Shield, Inc.'],
            ['name' => 'Cocolife Healthcare'],
            ['name' => 'Dynamic Care Corporation'],
            ['name' => 'Eastwest Healthcare, Inc.'],
            ['name' => 'Etiqa Life And General Assurance Philippines Inc (Asian Life & General Assurance Corp.)'],
            ['name' => 'Flexicare'],
            ['name' => 'Fortune Medicare, Inc.'],
            ['name' => 'Getwell Health Systems, Inc.'],
            ['name' => 'Health Maintenance, Inc.'],
            ['name' => 'Health Plan Philippines, Inc.'],
            ['name' => 'Insular Health Care, Inc. (I-Care)'],
            ['name' => 'Intellicare / Asalus Corp.'],
            ['name' => 'Kaiser International Health Group Inc.'],
            ['name' => 'Life & Health Hmp, Inc.'],
            ['name' => 'Maxicare Healthcare Corp. PhilCare'],
            ['name' => 'Medicard Philippines, Inc.'],
            ['name' => 'Medocare Health Systems, Inc.'],
            ['name' => 'Optimum Medical And Healthcare Services, Inc.'],
            ['name' => 'Pacific Cross Health Care'],
            ['name' => 'Phil Care, Inc. (Formerly Philamcare Health Systems, Inc.)'],
            ['name' => 'Value Care Health Systems, Inc.'],
            ['name' => 'Wellcare Health Maintenance '],
        ));
    }
}
