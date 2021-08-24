<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class Sms
{
    public $apiKey = 'c1546762ef0464e817844ccca8b05c82';
    public $apiSecret = '290b9558324986991ba35f6b54b830c8';
    public $URL = 'https://api.promotexter.com';

    public function __construct()
    {
        $this->guzzClient = new Client();
    }

    /**
     * Send sms to specified api client using guzzle.
     * 
     */
    public function sendSms($mobile, $messageKey, $options = [])
    {
        $jobs = [];
        $mobile = str_replace(' ', '', $mobile);
        $exploded = explode(',', $mobile);
        $text = $this->composeMessage($messageKey, $options);

        foreach ($exploded as $number) {
            $init['apiKey'] = $this->apiKey;
            $init['apiSecret'] = $this->apiSecret;
            $init['to'] = $number;
            $init['from'] = "MyHospital";
            $init['text'] = $text;
        }

        try {
            $response = $this->guzzRequest('POST', $init, "{$this->URL}/sms/send");
        } catch (\Exception $e) {
            logger('SMS Sending Exception: ' . $e->getMessage());
        }
    }

    public function composeMessage($messageKey, $options)
    {
        $text = '';

        switch ($messageKey) {
            case 'patient_service_booked':
                $text = 'Hi '.$options['first_name'].', your schedule request with reference #'.$options['reference_no'].' has been received. Please check your e-mail for payment instructions. Thank you.';
                break;

            case 'patient_uploaded_lab_file':
                $text = 'GREETINGS! You have received the following file from Patient '.$options['first_name'].'. If this is a deposit slip, please confirm schedule and approve transaction at '.route('center.bookings.details', ['booking' => $options['id']]).'.';
                break;

            case 'patient_uploaded_consultation_file':
                $text = 'Hi '.$options['doctor'].', You have received document from Patient '.$options['first_name'].'. If this is a deposit slip, please mark transaction as paid at '.route('appointment.patient.details', ['consultation' => $options['id']]).'. Thank you.';
                break;

            case 'patient_doctor_booked':
                $text = 'Hi '.$options['first_name'].', GREAT NEWS! Your consultation with reference #'.$options['reference_no'].' for doctor '.$options['doctor'].' for '.$options['booking_date'].' has been scheduled. Please send us your deposit slip to confirm your appointment. Thank you.';
                break;

            case 'patient_doctor_payment_made':
                $text = 'Hi '.$options['first_name'].', THANK YOU FOR YOUR PAYMENT. Your consultation request with reference #'.$options['reference_no'].' for doctor '.$options['doctor'].' on '.$options['booking_date'].' is now confirmed. Please check your email for full details. Thank you!';
                break;

            case 'doctor_uploaded_consultation_file':
                $text = 'GREETINGS! You received a document from Doctor '.$options['doctor'].'. To view the file, please check your email. Thank you.';
                break;

            case 'doctor_rescheduled_consultation_file':
                $text = 'Hi '.$options['first_name'].' '.$options['last_name'].', GREETINGS! your consultation request with reference #'.$options['reference_no'].' for Doctor '.$options['doctor'].' was rescheduled on '.$options['booking_date'].'.  Please check your e-mail for more details. Thank you.';
                break;

            case 'centeradmin_approved_appointment_request':
                $text = 'Hi '.$options['first_name'].' '.$options['last_name'].', your service request with reference #'.$options['reference_no'].' has been approved and scheduled.  Please check your e-mail for more details. Thank you.';
                break;

            default:
                break;
        }

         return $text;
    }


    // /**
    //  * Send sms to specified api client using guzzle.
    //  * 
    //  */
    // public function sendSms($mobile, $appKey = null, $options = [])
    // {
    //     $jobs = [];
    //     $mobile = str_replace(' ', '', $mobile);
    //     $exploded = explode(',', $mobile);
    //     foreach ($exploded as $number) {
    //         $init = $options;
    //         $init['security_key'] = $this->SECKEY;
    //         $init['app_key'] = $appKey;
    //         $init['number'] = $number;
    //         $jobs[] = $init;
    //     }

    //     try {
    //         $response = $this->guzzRequest('GET', ['data' => $jobs], "{$this->URL}one-time-sms-bulk");
    //     } catch (\Exception $e) {
    //         logger('SMS Sending Exception: ' . $e->getMessage());
    //     }
    // }

    /**
     * Send guzzle request to an api endpoint.
     * 
     */
    public function guzzRequest($method, $data, $url)
    {
        $response = $this->guzzClient->request(
            $method,
            $url,
            [
                'query' => $data,
                'timeout' => 30,
            ]
        );

        return $response;
    }

}