<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingLog extends Model
{
    protected $table = 'booking_logs';

    protected $guarded = [];

    /**
     * Relations
     * 
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bookingCenter()
    {
        return $this->belongsTo(BookingCenter::class);
    }

    public function bookingService()
    {
        return $this->belongsTo(BookingService::class);
    }

    /**
     * Attributes
     */

    public function getFormattedLogAttribute()
    {
    	return  $this->excerpt .' on '. $this->created_at;
    }
}

