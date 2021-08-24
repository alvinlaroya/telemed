<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    /**
     * Methods
     */

    public static function getName($name = '')
    {
        return self::where('name', $name)->first();
    }

    public function getMobiles()
    {
        $settings = $this->where('name', 'mobile_to_receive_notifications')->first();

        return $settings;
    }

    public static function getMobileEntry()
    {
        return (new self)->getMobiles();
    }
}
