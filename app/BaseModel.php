<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	const TIME_FORMAT = 'h:i A';
    const DATE_FORMAT = 'M-j-Y';
    const DATETIME_FORMAT = 'M-j-Y h:i A';
}