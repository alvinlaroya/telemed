<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
	use SoftDeletes;

    protected $casts = [
        'eligible' => 'boolean',
    ];

    protected $guarded = [];

    /**
     * Relations
     * 
     */

    public function category()
    {
    	return $this->belongsTo(ServiceCategory::class);
    }


    //Attribute

    public function getServiceDiscountAttribute()
    {
        $tmpDiscount = 0;
        if($this->eligible) {
            $tmpDiscount = $this->price * 0.2;
        }
        return $tmpDiscount;
    }

    public function getSerivceDiscountedAttribute()
    {
        $total = 0;
        $discount = $this->service_discount;
        $total = $this->price - $discount;
        return $total;
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withTimestamps();
    }
}
