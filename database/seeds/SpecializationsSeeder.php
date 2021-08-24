<?php

use Illuminate\Database\Seeder;

class SpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Lets truncate first
       \DB::table('specializations')->truncate();

       \DB::table('specializations')->insert(array(
            ['name' => 'Allergology& Immunology'],
            ['name' => 'Anesthesiology'],
            ['name' => 'Cardiology'],
            ['name' => 'Dental Medicine'],
            ['name' => 'Dermatology'],
            ['name' => 'Emergency Medicine'],
            ['name' => 'Endocrinology'],
            ['name' => 'Gastroenterology'],
            ['name' => 'General Medicine'],
            ['name' => 'Hematology'],
            ['name' => 'Infectious Disease'],
            ['name' => 'Legal Medicine'],
            ['name' => 'Nephrology'],
            ['name' => 'Neurology'],
            ['name' => 'Neurosurgery'],
            ['name' => 'Nuclear Medicine'],
            ['name' => 'Obstetrics & Gynecology'],
            ['name' => 'Oncology'],
            ['name' => 'Ophthalmology'],
            ['name' => 'Ortholaryngology'],
            ['name' => 'Orthopaedic & Orthopaedic Surgery'],
            ['name' => 'Otorhinolaryngology'],
            ['name' => 'Pathology'],
            ['name' => 'Pediatrics'],
            ['name' => 'Physical Medicine & Rehabilitaion'],
            ['name' => 'Psychiatry'],
            ['name' => 'Psychology'],
            ['name' => 'Diagnostic Radiology & CT MRI'],
            ['name' => 'Interventional Radiology'],
            ['name' => 'Radiation Oncology'],
            ['name' => 'Ultrasound'],
            ['name' => 'Rheumatology'],
            ['name' => 'Colorectal Surgery'],
            ['name' => 'General Surgery'],
            ['name' => 'Pediatric Surgery'],
            ['name' => 'Peripheral Vascular Surgery'],
            ['name' => 'Reconstructive & Cosmetic Plastic Surgery'],
            ['name' => 'Thoracic & Cardio Vascular Sorgery'],
            ['name' => 'Urology'],
        ));
    }
}
