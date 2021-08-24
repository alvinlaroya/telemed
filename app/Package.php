<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function hasFollowUpService()
    {
        return $this->services()->where('product_code', 'follow-up')->count() ? true : false;
    }

    public function getCenters()
    {
        $centers = [];

        if($this->services()->count() > 0) {
            foreach($this->services as $service) {
                if($service->product_code != 'follow-up') {
                    $centers[$service->category->id] = $service->category->name; 
                }
            }
        }

        return array_unique($centers);
    }

}
