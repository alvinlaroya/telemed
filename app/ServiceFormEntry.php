<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceFormEntry extends Model
{
    protected $table = 'form_service_entry';

    protected $dates = ['date_time', 'created_at', 'updated_at'];
    protected $casts = [
        'other_answers' => 'array'
    ];
}
