<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    const BOOKING = 'booking';
	const CONSULTATION = 'consultation';

    protected $dates = [
        'birthdate',
    ];

    protected $casts = [
        'pwd_senior' => 'boolean',
    ];

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'mobile',
        'email',
        'province_id',
        'city_id',
        'barangay',
        'street',
        'house_number',
        'zipcode',
        'birthdate',
        'gender',
        'type',
        'pwd_senior',
        'id_number',
        'is_fallrisk',
        'screening_exp'
    ];


    /**
     * Relations
     * 
     */

    public function bookings()
    {
    	return $this->hasMany(Booking::class);
    }

    public function consultatios()
    {
        return $this->hasMany(Consultation::class);
    }

    public function screening()
    {
        return $this->hasOne(PatientScreening::class);
    }

    public function screenings()
    {
        return $this->hasMany(PatientScreening::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isSeniorPwd()
    {
        return $this->pwd_senior == 1 ? true : false;
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class, 'user_id', 'user_id');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'user_id');
    }

    /**
     * Attributes
     * 
     */

    public function getNameAttribute()
    {
    	return $this->middle_name ? $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name : $this->first_name .' '. $this->last_name;
    }

    public function getAgeAttribute()
    {
        if (!$this->birthdate) return 'n/a';

        return $this->birthdate->age;
    }

    public function getAgeFormattedAttribute()
    {
        if (!$this->birthdate) return 'n/a';

        return $this->age . ' yrs old';
    }

    /**
     * Methods
     */

    public function getFirstScreeningForm()
    {
        return $this->screenings()->oldest()->first();
    }

    public function getLatestScreeningForm()
    {
        return $this->screenings()->latest()->first();
    }
}
