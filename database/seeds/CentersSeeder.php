<?php

use Illuminate\Database\Seeder;

class CentersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lets truncate first
        \DB::table('service_categories')->truncate();
        // Inser new records
        \DB::table('service_categories')->insert(array(
            array(
                'name' => 'Hematology',
                'description' => '',
            ),
            array(
                'name' => 'Immunology & Serology',
                'description' => '',
            ),
            array(
                'name' => 'Molecular Laboratory',
                'description' => '',
            ),
            array(
                'name' => 'Central Sterilization Unit',
                'description' => '',
            ),
            array(
                'name' => 'Eye Center (Carlos L. Sevilla)',
                'description' => '',
            ),
            array(
                'name' => 'CVDL-Heart Station',
                'description' => '',
            ),
            array(
                'name' => 'Cancer Center',
                'description' => '',
            ),
            array(
                'name' => 'Cardiac Cath Lab',
                'description' => '',
            ),
            array(
                'name' => 'Ultrasound',
                'description' => '',
            ),
            array(
                'name' => 'Diabetes Care Center',
                'description' => '',
            ),
            array(
                'name' => 'ENT Center',
                'description' => '',
            ),
            array(
                'name' => 'Endoscopy Unit',
                'description' => '',
            ),
            array(
                'name' => 'HSD - DERMATOLOGY',
                'description' => '',
            ),
            array(
                'name' => 'Home Care & Hospice',
                'description' => '',
            ),
            array(
                'name' => 'Kidney Unit',
                'description' => '',
            ),
            array(
                'name' => 'Lab-Blood Bank',
                'description' => '',
            ),
            array(
                'name' => 'MCF Dermlaser & Phototherapy',
                'description' => '',
            ),
            array(
                'name' => 'MakatiMed Health Hub',
                'description' => '',
            ),
            array(
                'name' => 'Neurosciences-DTMS-Laboratory',
                'description' => '',
            ),array(
                'name' => 'Neurosciences-Neurophysiology & Sleep Disorders',
                'description' => '',
            ),
            array(
                'name' => 'Neurosciences-Subspecialty Clinic',
                'description' => '',
            ),
            array(
                'name' => 'Nuclear Medicine',
                'description' => '',
            ),
            array(
                'name' => 'Osteoporosis & Bone Health',
                'description' => '',
            ),
            array(
                'name' => 'Pain Management Services',
                'description' => '',
            ),
            array(
                'name' => 'Pediatric Development & Rehabilitation',
                'description' => '',
            ),array(
                'name' => 'Physical Medicine & Rehabilitation Center',
                'description' => '',
            ),
            array(
                'name' => 'Pulmonary Laboratory',
                'description' => '',
            ),
            array(
                'name' => 'RJO Cataract & Refractive Laser Surgical Center',
                'description' => '',
            ),
        ));
    }
}
