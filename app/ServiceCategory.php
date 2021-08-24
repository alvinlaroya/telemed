<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCategory extends Model
{
	use SoftDeletes;

    protected $guarded = [];

    /**
     * Relations
     *
     */

    public function users()
    {
        return $this->belongsToMany(User::class, 'center_user', 'center_id', 'user_id');
    }

    public function services()
    {
    	return $this->hasMany(Service::class, 'category_id');
    }
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function customFields()
    {
    	return $this->hasMany(ServiceForm::class, 'center_id');
    }

    // getters

    public function getEmailRecepientsAttribute()
    {
        return array_filter(
            explode(',', $this->email_to_receive_notifications)
        );
    }

    public function getMobileRecepientsAttribute()
    {
        return array_filter(
            explode(',', $this->mobile_to_receive_notifications)
        );
    }
}
