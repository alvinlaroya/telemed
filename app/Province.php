<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

}
