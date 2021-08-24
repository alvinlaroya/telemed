<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Notifiable;

    protected $guarded = [];
    protected $fillable = ['user_id', 'id_number', 'first_name', 'last_name', 'suffix', 'email', 'mobile', 'telephone', 'gender', 'description', 'clinic_days', 'payment_instructions', 'consultation_fee', 'consultation_duration', 'email_to_receive_notifications', 'mobile_to_receive_notifications', 'zoom_key', 'zoom_secret'];

    protected $casts = [
        'clinic_days' => 'array',
    ];

    /**
     * Relations
     * 
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function secretaries()
    {
        return $this->belongsToMany(User::class, 'doctor_user', 'doctor_id', 'user_id');
    }

    public function specializations()
    {
    	return $this->belongsToMany(Specialization::class, 'doctor_specialization', 'doctor_id', 'specialization_id');
    }

    public function hmos()
    {
    	return $this->belongsToMany(HmoAccreditation::class, 'doctor_hmo', 'doctor_id', 'hmo_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Attributes
     * 
     */

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getPictureAttribute()
    {
        return $this->getFirstMediaUrl('avatar');
        $picture = $this->getMedia()->last();
        $url = $picture ? asset("storage/{$picture->id}/{$picture->file_name}") : null;
        return $url;
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->useFallbackUrl('/img/placeholder.gif')
            ->useFallbackPath(public_path('/img/placeholder.gif'))
            ->singleFile();
    }

    public function getClinicDaysFormattedAttribute()
    {
        $data = [];
        foreach ((array) $this->clinic_days as $day) {
            $data[] = \App\Date::$dayShort[$day] ?? '';
        }

        return implode(' ', $data);
    }

    public function getDisplayNameAttribute()
    {
        return $this->last_name .', '. $this->first_name;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name .' '. $this->last_name;
    }

    public function getSpecializationsFormattedAttribute()
    {
        return $this->specializations->implode('name', ', ');
    }

    public function getHmosFormattedAttribute()
    {
        return $this->hmos->implode('name', ', ');
    }

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

    /**
     * Methods
     */

    public function slugifyName($exceptId = null)
    {
        $counter = 0;
        do {
            $name = $this->name . ($counter ?: '');
            $slug = Str::of($name)->slug('-');
            $counter++;
        } while (
            self::withTrashed()
                ->where('slug', $slug)
                ->when($exceptId, function($q) use ($exceptId) {
                    $q->where('id', '!=', $exceptId);
                })
                ->first()
        );

        return $slug;
    }

    protected static function booted()
    {
        static::creating(function ($doctor) {
            $doctor->slug = $doctor->slugifyName();
        });

        static::updating(function ($doctor) {
            $doctor->slug = $doctor->slugifyName($doctor->id);
        });
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class, 'user_id', 'user_id');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'user_id');
    }

    public function isCovidCareCenter()
    {
        return (bool) $this->specializations()->where('name', 'Covid Care Center')->count() ? true : false;
    }

}
