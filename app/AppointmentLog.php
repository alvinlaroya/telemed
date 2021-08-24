<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentLog extends Model
{
    protected $table = 'appointment_logs';

    protected $guarded = [];

    /**
     * Relations
     * 
     */

    public function appointment()
    {
    	return $this->belongsTo(Consultation::class);
    }
}
