<?php

namespace App\Jobs;

use App\Helpers\Sms;
use App\SmsNotifSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSmsSending implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $key;
    public $mobile;
    public $options;

    /**
     * ProcessSmsSending constructor.
     * @param $key app key that exist in textify account
     * @param $mobile Comma separated for multi numbers
     * @param $options parameters see textify options for details
     */
    public function __construct($key, $mobile, $options)
    {
        $this->key = $key;
        $this->mobile = $mobile;
        $this->options = $options;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$smsSettings = new SmsNotifSettings();

        //$val = $smsSettings->getValue($this->key);
        // If naka enable yung settings
        //if ($val && $val->value) {
            //$appKey = SmsNotifSettings::$appKeys[$this->key];
            $sms = new Sms();

            if(!is_array($this->mobile)){
                if( ( substr( $this->mobile, 0, 3 ) === "+63" || substr( $this->mobile, 0, 2 ) === "09" ) ){
                    logger('mobile number valid - sms sending');
                    $res = $sms->sendSms($this->mobile, $this->key, $this->options);
                    return $res;
                }else{
                    logger('international number - sms disabled');
                    return;
                }
            }else{
                logger('array of mobile numbers - proceed to sending');
                $res = $sms->sendSms($this->mobile, $this->key, $this->options);
                return $res;
            }

        //}
    }
}
