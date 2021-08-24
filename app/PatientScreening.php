<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientScreening extends Model
{
    protected $table = 'patient_screenings';

    protected $casts = [
        'data' => 'array',
        'fallrisk' => 'array'
    ];

    protected $guarded = [];

    /**
     * Relations
     * 
     */

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
