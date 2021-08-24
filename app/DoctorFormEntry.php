<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorFormEntry extends Model
{
    protected $table = 'form_doctors_entry';

    protected $dates = ['date_time', 'created_at', 'updated_at'];
    protected $casts = [
        'other_answers' => 'array'
    ];
}
