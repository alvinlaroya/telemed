<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lets truncate first
        \DB::table('settings')->truncate();
        // Inser new records
        \DB::table('settings')->insert(array(
            array(
                'title' => 'Admin Emails ( For multiple recipients put a comma in between e-mail addresses )',
                'name' => 'admin_emails',
                'type' => 'tags',
                'value' => 'admin@test.com',
                'created_at' => now(),
                'updated_at' => now()
            ),
            array(
                'title' => 'Email to Receive Notifications ( For multiple recipients put a comma in between e-mail addresses )',
                'name' => 'email_to_receive_notifications',
                'type' => 'tags',
                'value' => 'admin@test.com',
                'created_at' => now(),
                'updated_at' => now()
            ),
            array(
                'title' => 'Mobile to Receive Notifications | <small style="color:#e3342f">Ex: 09123456789</small> | ( For multiple recipients put a comma in between mobile numbers )',
                'name' => 'mobile_to_receive_notifications',
                'type' => 'tags',
                'value' => '0964654656546',
                'created_at' => now(),
                'updated_at' => now()
            ),
            array(
                'title' => 'Service Booking Maintenance Mode',
                'name' => 'service_maintenance_mode',
                'type' => 'toggle',
                'value' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ),
            array(
                'title' => 'Service Booking Maintenance Mode Notice',
                'name' => 'service_maintenance_mode_text',
                'type' => 'textarea',
                'value' => 'We apologize for the inconvenience but we are performing some maintenance at the moment. We`ll be back shortly.',
                'created_at' => now(),
                'updated_at' => now()
            ),
            array(
                'title' => 'Doctor Appointments Maintenance Mode',
                'name' => 'doctor_maintenance_mode',
                'type' => 'toggle',
                'value' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ),
            array(
                'title' => 'Doctor Appointments Maintenance Mode Notice',
                'name' => 'doctor_maintenance_mode_text',
                'type' => 'textarea',
                'value' => 'We apologize for the inconvenience but we are performing some maintenance at the moment. We`ll be back shortly.',
                'created_at' => now(),
                'updated_at' => now()
            ),
        ));

        \App\SmsNotifSettings::truncate();

        $notifSettings = [
            [
                'name' => 'admin_service_booked',
                'group' => 1,
                'value' => true,
            ],
            [
                'name' => 'patient_service_booked',
                'group' => 1,
                'value' => true,
            ],
            [
                'name' => 'patient_service_approved',
                'group' => 1,
                'value' => true,
            ],
            [
                'name' => 'patient_service_approved2',
                'group' => 1,
                'value' => true,
            ],
            [
                'name' => 'admin_service_payment_made',
                'group' => 1,
                'value' => true,
            ],
            [
                'name' => 'patient_service_payment_made',
                'group' => 1,
                'value' => true,
            ],
            [
                'name' => 'patient_service_confirmed',
                'group' => 1,
                'value' => true,
            ],
            [
                'name' => 'patient_service_reminder',
                'group' => 1,
                'value' => true,
            ],
            [
                'name' => 'patient_next_screening',
                'group' => 1,
                'value' => true,
            ],
            [
                'name' => 'doctor_doctor_booked',
                'group' => 2,
                'value' => true,
            ],
            [
                'name' => 'doctor_appointment_reminder',
                'group' => 2,
                'value' => true,
            ],
            [
                'name' => 'patient_doctor_booked',
                'group' => 2,
                'value' => true,
            ],
            [
                'name' => 'patient_doctor_approved',
                'group' => 2,
                'value' => true,
            ],
            [
                'name' => 'patient_doctor_rescheduled',
                'group' => 2,
                'value' => true,
            ],
            [
                'name' => 'patient_doctor_payment_made',
                'group' => 2,
                'value' => true,
            ],
            [
                'name' => 'patient_doctor_confirmed',
                'group' => 2,
                'value' => true,
            ],
        ];

        \DB::table('smsnotif_settings')->insert($notifSettings);
    }
}
