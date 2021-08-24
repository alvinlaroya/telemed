<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DoctorUser extends Pivot
{
    public $incrementing = true;
}
