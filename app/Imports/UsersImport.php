<?php

namespace App\Imports;

use App\User;
use App\Specialization;
use App\HmoAccreditation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{

    public function model(array $row)
    {

        $user = User::create([
            'name' => $row['first_name'] . ' ' . $row['last_name'],
            'email' => $row['email'],
            'password' => bcrypt($row['email']),
            'role' => 'doctor',
            'status' => 1
        ]);

        $specializations = Specialization::whereIn('name', explode('|', $row['specializations']))->get();

        $hmoAccreditations = HmoAccreditation::whereIn('name', explode('|', $row['hmo_accreditations']))->get();

        $userData = [
            'id_number' => $row['id_number'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'slug' => $row['first_name'] . '-' . $row['last_name'],
            'email' => $row['email'],
            'mobile' => $row['mobile'],
            'telephone' => $row['telephone'],
            'gender' => $row['gender'],
            'description' => $row['description'],
            'consultation_fee' => $row['consultation_fee'],
            'consultation_duration' => $row['consultation_duration'],
            'zoom_key' => $row['zoom_key'],
            'zoom_secret' => $row['zoom_secret'],
            'email_to_receive_notifications' => empty($row['email_to_receive_notifications']) ? '' : str_replace('|', ',', $row['email_to_receive_notifications']),
            'mobile_to_receive_notifications' => empty($row['mobile_to_receive_notifications']) ? '' : str_replace('|', ',', $row['mobile_to_receive_notifications']),
            'payment_instructions' => $row['payment_instructions'],
            'clinic_days' => '' //json_encode(array_map('strval', json_decode($row['clinic_days'])))
        ];
        
        $doctor = $user->doctor()->create($userData);

        if(count($specializations) > 0) {
            $doctor->specializations()->attach($specializations);
        }

        if(count($hmoAccreditations) > 0) {
            $doctor->hmos()->attach($hmoAccreditations);
        }

        return $user;
    }

    public function rules(): array
    {
        return [
            '*.first_name' => ['required', 'max:100'],
            '*.last_name' => ['required', 'max:100'],
            '*.email' => ['required', 'email', 'unique:users', 'max:191']
        ];
    }

    public function headingRow()
    {
        return 1;
    }

}
