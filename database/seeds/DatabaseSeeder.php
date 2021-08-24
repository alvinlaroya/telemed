<?php

use App\Doctor;
use App\Leave;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(SettingsTableSeeder::class);
        // $this->call(CentersSeeder::class); // may excel import
        // $this->call(ServicesSeeder::class); // may excel import
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(SpecializationsSeeder::class);
        $this->call(HMOSeeder::class);
        $this->call(CorporateSeeder::class);

        \DB::table('users')->insert(array(
            array(
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'role' => User::SUPERADMIN,
                'password' => Hash::make('admin123'),
            ),
            array(
                'name' => 'Juan',
                'email' => 'juan@email.com',
                'role' => User::ADMIN,
                'password' => Hash::make('admin123'),
            ),
            array(
                'name' => 'Doctor One',
                'email' => 'doctor@email.com',
                'role' => User::DOCTOR,
                'password' => Hash::make('admin123'),
            ),
            array(
                'name' => 'Doctor Two',
                'email' => 'doctor2@email.com',
                'role' => User::DOCTOR,
                'password' => Hash::make('admin123'),
            ),
        ));

        $d = new Doctor;
        $d->user_id = 3;
        $d->id_number = '231231';
        $d->first_name = 'Doctor';
        $d->last_name = 'One';
        $d->email = 'doctor@email.com';
        $d->mobile = '0934576353';
        $d->gender = 'male';
        $d->consultation_fee = 100;
        $d->save();

        $d2 = new Doctor;
        $d2->user_id = 4;
        $d2->id_number = '231245';
        $d2->first_name = 'Doctor';
        $d2->last_name = 'Two';
        $d2->email = 'doctor2@email.com';
        $d2->mobile = '09874546565';
        $d2->gender = 'male';
        $d2->consultation_fee = 50;
        $d2->save();

        Leave::insert([
            ['name' => 'Off'],
        ]);
    }
}
