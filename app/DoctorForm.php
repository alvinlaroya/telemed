<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorForm extends Model
{
    protected $table = 'form_doctors';

    protected $casts = [
        'options' => 'array'
    ];
}
