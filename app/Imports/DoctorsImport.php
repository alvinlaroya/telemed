<?php

namespace App\Imports;

use App\Date;
use App\User;
use App\Doctor;
use App\Specialization;
use App\HmoAccreditation;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DoctorsImport implements OnEachRow, WithHeadingRow, WithChunkReading
{
    public function onRow(Row $row)
    {
        $row = (object) $row->toArray();
        echo $row->first_name.PHP_EOL;

        $doctor = new Doctor;
        $doctor->id_number = $row->id_number;
        $doctor->first_name = $row->first_name;
        $doctor->last_name = $row->last_name;
        $doctor->email = $row->email;
        $doctor->mobile = $row->mobile;
        $doctor->telephone = $row->telephone;
        $doctor->gender = $row->gender;
        $doctor->consultation_fee = $row->consultation_fee;
        $doctor->consultation_duration = $row->consultation_duration;
        $doctor->clinic_days = $this->formatClinicDays($row);
        $doctor->email_to_receive_notifications = $row->email_to_receive_notifications;
        $doctor->mobile_to_receive_notifications = $row->sms_to_receive_notifications;

        $user = new User;
        $user->name = $doctor->name;
        $user->email = $doctor->email;
        $user->password = Hash::make($row->password ?? 'telemd2020');
        $user->role = User::DOCTOR;
        $user->save();
        
        $doctor = $user->doctor()->save($doctor);

        $speclzn = Specialization::where('name', $row->specialization)->first();
        if ($speclzn) {
            $doctor->specializations()->attach($speclzn);
        }
        $hmo = HmoAccreditation::where('name', $row->hmo_accreditation)->first();
        if ($hmo) {
            $doctor->hmos()->attach($hmo);
        }
    }

    public function formatClinicDays($row)
    {
        $data = [];
        if ($row->clinic_on_mon == 'yes') {
            $data[] = Date::MONDAY;
        }
        if ($row->clinic_on_tue == 'yes') {
            $data[] = Date::TUESDAY;
        }
        if ($row->clinic_on_wed == 'yes') {
            $data[] = Date::WEDNESDAY;
        }
        if ($row->clinic_on_thu == 'yes') {
            $data[] = Date::THURSDAY;
        }
        if ($row->clinic_on_fri == 'yes') {
            $data[] = Date::FRIDAY;
        }
        if ($row->clinic_on_sat == 'yes') {
            $data[] = Date::SATURDAY;
        }
        return $data;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
