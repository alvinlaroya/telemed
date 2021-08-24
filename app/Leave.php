<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
	protected $guarded = [];

    /**
     * Relations
     * 
     */

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
