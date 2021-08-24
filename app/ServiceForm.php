<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceForm extends Model
{
    protected $table = 'form_service';

    protected $guarded = [];

    protected $casts = [
        'options' => 'array'
    ];

    public function scopeOfCenter($query, ServiceCategory $center)
    {
        return $query->where('center_id', $center->id);
    }
}
