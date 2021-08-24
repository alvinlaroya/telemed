<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsNotifSettings extends Model
{
    protected $table = 'smsnotif_settings';

    protected $casts = [
        'value' => 'boolean'
    ];

    public static $group = [
        1 => 'Service Bookings',
        2 => 'Doctor Consultation Bookings'
    ];

    public static $labels = [
        'admin_service_booked' => 'Admin receive SMS once "Service" has been booked',
        'patient_service_booked' => 'Patient receive SMS once "Service" has been booked',
        'patient_service_approved' => 'Patient receive SMS once "Service" has been approved',
        'patient_service_approved2' => 'Patient receive SMS once "Service" has been approved (Guarantor)',
        'admin_service_payment_made' => 'Admin receive SMS once payment made for "Service" booked',
        'patient_service_payment_made' => 'Patient receive SMS once payment made for "Service" booked',
        'patient_service_confirmed' => 'Patient receive SMS once "Service" has been confirmed',
        'patient_service_reminder' => 'Patient receive SMS reminder for upcoming scheduled request',
        'doctor_doctor_booked' => 'Doctor receive SMS once "Doctor Consultation" has been booked',
        'doctor_appointment_reminder' => 'Doctor receive SMS reminder for upcoming appointments',
        'patient_doctor_booked' => 'Patient receive SMS once "Doctor Consultation" has been booked',
        'patient_doctor_approved' => 'Patient receive SMS once "Doctor Consultation" has been approved',
        'patient_doctor_rescheduled' => 'Patient receive SMS once "Doctor Consultation" has been rescheduled',
        'patient_doctor_payment_made' => 'Patient receive SMS once payment made for "Doctor Consultation"',
        'patient_doctor_confirmed' => 'Patient receive SMS once "Doctor Consultation" has been confirmed',
        'patient_next_screening' => 'Patient receive SMS 2 days before his/her next screening',
    ];

    // Templates manageable via, Textify account ask JR for creds
    public static $appKeys = [
        'admin_service_booked' => '091561c78555447057ac7b04072fd813a9395ae7',
        'patient_service_booked' => '7e8e58e9b294a3cd7a8bbef44b9322a15f480c87',
        'patient_service_approved' => 'f193abc9825f073eadba72168410500674062cbf',
        'patient_service_approved2' => '5978c3df5240a7e95b4155b838fc712637ddf7b2',
        'admin_service_payment_made' => '108430519063732094b7ee5846756ffda20ca02c',
        'patient_service_payment_made' => 'b6d2d42afb281c6de8753a258c105101a2ca0c4c',
        'patient_service_confirmed' => '476674ea96e7accd39ab38c51e47152e19ba2307',
        'patient_service_reminder' => '22da37897ca2efcc4b824b6876610c0f6c5eaef1',
        'doctor_doctor_booked' => '601cdaec4687b4748e8dbf94f666235091803035',
        'doctor_appointment_reminder' => '74998aa6db6d029f5561cc659b1a3b11d19ade39',
        'patient_doctor_booked' => '0198637e92fd8d47dcc09c686d3d3d75bfd42606',
        'patient_doctor_approved' => '5770fc4e0570217af5196740e4c17a280c89e514',
        'patient_doctor_rescheduled' => 'c92e23e0391d167b6fac0098c518d50570db69e6',
        'patient_doctor_payment_made' => '5971e7465b814ea332db9a74739c7690355f2124',
        'patient_doctor_confirmed' => '6b0c118149bc925e53273bbfed15c25a8f5c89d9',
        'patient_next_screening' => '2adb9b2eef25bac8b7aee50523127c37ed7605cf',
    ];

    public function getValue($key) {
        return $this->select('value')->where('name', $key)->first();
    }

    public static function getVal($key)
    {
        return (new self)->getValue($key);
    }
}
