<?php

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Lets truncate first
       \DB::table('services')->truncate();
       // Inser new records
       \DB::table('services')->insert(array(
           array(
               'name' => 'CBC (COMPLETE BLOOD COUNT)',
               'description' => '',
               'category_id' => 1,
               'price' => 515
           ),
           array(
               'name' => 'DENGUE DUO IGG/IGM',
               'description' => '',
               'category_id' => 2,
               'price' => 1815
           ),
           array(
                'name' => 'DENGUE DUO IGG/IGM - STAT',
                'description' => '',
                'category_id' => 2,
                'price' => 2870
           ),
           array(
                'name' => 'DENGUE NS 1',
                'description' => '',
                'category_id' => 2,
                'price' => 2575
           ),
           array(
                'name' => 'DENGUE RNA PCR (SCREENING)',
                'description' => '',
                'category_id' => 3,
                'price' => 9500
           ),
           array(
                'name' => 'DNA PROFILE (STR SEQUENCING)',
                'description' => '',
                'category_id' => 3,
                'price' => 28000
           ),
           array(
                'name' => 'HLA-B27 (PCR)',
                'description' => '',
                'category_id' => 3,
                'price' => 11300
           ),
           array(
                'name' => 'COVID 19 TEST',
                'description' => '',
                'category_id' => 3,
                'price' => 8150
           ),
           array(
                'name' => 'BALKAN FRAME DAILY',
                'description' => '',
                'category_id' => 4,
                'price' => 161
           ),
           array(
                'name' => 'HEATING PAD DAILY',
                'description' => '',
                'category_id' => 4,
                'price' => 136
           ),
           array(
                'name' => 'ORTHRO TRAY SMALL',
                'description' => '',
                'category_id' => 4,
                'price' => 500
           ),
           array(
                'name' => 'ORTHO TRAY MEDIUM',
                'description' => '',
                'category_id' => 4,
                'price' => 1000
           ),
           array(
                'name' => 'ORTHO TRAY LARGE',
                'description' => '',
                'category_id' => 4,
                'price' => 1500
           ),
           array(
                'name' => 'EYE ULTRASOUND - B SCAN ONE EYE',
                'description' => '',
                'category_id' => 5,
                'price' => 2870
           ),
           array(
                'name' => 'FLUORESCEIN ANGIOGRAM',
                'description' => '',
                'category_id' => 5,
                'price' => 4000
           ),
           array(
                'name' => 'FOCAL LASER ONE EYE',
                'description' => '',
                'category_id' => 5,
                'price' => 4000
            ),
            array(
                'name' => 'FUNDUS PHOTO ONE EYE',
                'description' => '',
                'category_id' => 5,
                'price' => 1800
            ),
            array(
                'name' => '24HRS BLOOD PRESSURE MONITORING',
                'description' => '',
                'category_id' => 6,
                'price' => 3595
            ),
            array(
                'name' => '24HRS HOLTER MONITORING',
                'description' => '',
                'category_id' => 6,
                'price' => 6685
            ),
            array(
                'name' => '2D ECHOCARDIOGRAM',
                'description' => '',
                'category_id' => 6,
                'price' => 7200
            ),
            array(
                'name' => 'DOBUTAMINE STRESS ECHOCARDIOGRAM',
                'description' => '',
                'category_id' => 6,
                'price' => 14020
            ),
            array(
                'name' => '12 LEAD ECG',
                'description' => '',
                'category_id' => 6,
                'price' => 850
            ),
            array(
                'name' => 'MULTI DISCIPLINARY CONSULTATION FEE',
                'description' => '',
                'category_id' => 7,
                'price' => 2060
            ),
            array(
                'name' => 'INJECTION FEE (SC/IM)',
                'description' => '',
                'category_id' => 7,
                'price' => 515
            ),
            array(
                'name' => 'MULTI DISCIPLINARY TELECONFERENCE CONSULTATION FEE',
                'description' => '',
                'category_id' => 7,
                'price' => 1560
            ),
            array(
                'name' => 'CEREBRAL ANGIOGRAM',
                'description' => '',
                'category_id' => 8,
                'price' => 38110
            ),
            array(
                'name' => 'CEREBRAL ANGIOGRAM - STAT',
                'description' => '',
                'category_id' => 8,
                'price' => 57165
            ),
            array(
                'name' => '3D ULTRASOUND GYNE',
                'description' => '',
                'category_id' => 9,
                'price' => 4400
            ),
            array(
                'name' => '3D ULTRASOUND OB',
                'description' => '',
                'category_id' => 9,
                'price' => 4400
            ),
            array(
                'name' => '4D ULTRASOUND OB',
                'description' => '',
                'category_id' => 9,
                'price' => 5750
            ),
            array(
                'name' => 'BIO PHYSICAL SCORING OB',
                'description' => '',
                'category_id' => 9,
                'price' => 3400
            ),
       ));
    }
}
