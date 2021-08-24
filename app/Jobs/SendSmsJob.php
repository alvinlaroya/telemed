<?php

namespace App\Jobs;

use App\Helpers\Sms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $mobile;
    private $options;
    private $key;
    /**
     * Create a new job instance.
     *
     * @return void
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
         $sms = new Sms();

        if(!is_array($this->mobile)) {
            if( ( substr( $this->mobile, 0, 3 ) === "+63" || substr( $this->mobile, 0, 2 ) === "09" ) ) {
                logger('mobile number valid - sms sending');
                $res = $sms->sendSms($this->mobile, $this->key, $this->options);
                return $res;
            }else{
                logger('international number - sms disabled');
                return;
            }
        } else {
            logger('array of mobile numbers - proceed to sending');
            $res = $sms->sendSms($this->mobile, $this->key, $this->options);
            return $res;
        }

    }
}
