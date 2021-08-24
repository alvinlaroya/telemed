<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasMediaTrait;

    const ADMIN = 'admin';
    const DOCTOR = 'doctor';
    const SECRETARY = 'secretary';
    const SUPERADMIN = 'superadmin';
    const CENTERADMIN = 'centeradmin';
    const MEDICAL_SERVICES = 'medical_services';
    const SUPPORT = 'support';
    const PATIENT = 'patient';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'agreed_to_terms'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $adminRoles = [
        self::SUPERADMIN => 'Super Admin',
        self::ADMIN => 'Admin',
        self::CENTERADMIN => 'Center Admin',
        self::MEDICAL_SERVICES => 'Medical Services',
        self::SUPPORT => 'Support',
        self::PATIENT => 'Patient'
    ];

    /**
     * Relations
     * 
     */

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function centers()
    {
        return $this->belongsToMany(ServiceCategory::class, 'center_user', 'user_id', 'center_id');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Helper methods
     */

    public function isAdmin()
    {
        return $this->role == $this::SUPERADMIN || $this->role == $this::ADMIN;
    }

    public function isDoctor()
    {
        return $this->role == $this::DOCTOR || $this->role == $this::SECRETARY;
    }

    public function isSecretary()
    {
        return $this->role == $this::SECRETARY;
    }

    public function isCenterAdmin()
    {
        return $this->role == $this::CENTERADMIN;
    }

    public function isMedicalServices()
    {
        return $this->role == $this::MEDICAL_SERVICES;
    }

    public function isSupport()
    {
        return $this->role == $this::SUPPORT;
    }

    public function isPatient()
    {
        return $this->role == $this::PATIENT;
    }


    // get doctor of the secretary
    public function assignedDoctor()
    {
        return $this->hasOneThrough(Doctor::class, DoctorUser::class, 'user_id', 'id', 'id', 'doctor_id');
    }

    public function assignedCenter()
    {
        return $this->hasOneThrough(ServiceCategory::class, CenterUser::class, 'user_id', 'id', 'id', 'center_id');
    }

    public function center()
    {
        return $this->assignedCenter()->first();
    }

    public function assignedCentersArr()
    {
        $arr = [];
        foreach($this->assignedCenter()->get() as $key => $center) {
            array_push($arr, $center->id);
        }
        return $arr;
    }

    public function getRoleFormattedAttribute()
    {
        return self::$adminRoles[$this->role] ?? $this->role;
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }
}
