<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HmoAccreditation extends Model
{
    use SoftDeletes;

    /**
     * Relations
     * 
     */

    public function doctors()
    {
    	return $this->belongsToMany(Doctor::class, 'doctor_hmo', 'hmo_id', 'doctor_id');
    }
}
