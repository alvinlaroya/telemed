<?php

use Illuminate\Database\Seeder;

class ConsultationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lets truncate first
        \DB::table('consultations')->truncate();
        // Inser new records
        \DB::table('consultations')->insert(array(
            array(
                'first_name' => 'Mark',
                'last_name' => 'Doe',
                'mobile' => '093568785647',
                'email' => 'markdoe@test.com',
                'complaint' => 'This is for testing purposes only',
                'date_time' => now(),
                'doctor_id' => 1,
                'actual_datetime' => now(),
                'status' => 'confirmed'
            ),
            array(
                'first_name' => 'Juan',
                'last_name' => 'Cruz',
                'mobile' => '0935685747467',
                'email' => 'juancruz@test.com',
                'complaint' => 'This is for testing purposes only',
                'date_time' => '2020-05-03 13:11:00',
                'doctor_id' => 1,
                'actual_datetime' => '2020-05-03 13:11:00',
                'status' => 'confirmed'
            ),
            array(
                'first_name' => 'Ricardo',
                'last_name' => 'Dalisay',
                'mobile' => '0935685747467',
                'email' => 'cardo@test.com',
                'complaint' => 'This is for testing purposes only',
                'date_time' => '2020-05-23 10:11:00',
                'doctor_id' => 1,
                'actual_datetime' => '2020-05-23 10:11:00',
                'status' => 'confirmed'
            ),
        ));
    }
}
