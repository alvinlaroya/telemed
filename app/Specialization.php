<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialization extends Model
{
	use SoftDeletes;

    /**
     * Relations
     * 
     */

    public function doctors()
    {
    	return $this->belongsToMany(Doctor::class, 'doctor_specialization', 'specialization_id', 'doctor_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public static function getParents()
    {
        $parents = self::whereNull('parent_id')->get();
        return $parents;
    }
}
