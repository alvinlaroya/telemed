<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Support\Facades\Notification;

class Consultation extends Model implements HasMedia
{
    use HasMediaTrait;

	const PENDING = 'pending';
	const APPROVED = 'approved';
	const CONFIRMED = 'confirmed';
	const COMPLETED = 'completed';
	const CANCELLED = 'cancelled';
    const EXPIRED = 'expired';

    const ONLINE = 'online';
    const WALKIN = 'walkin';

    public static $types = [
        self::ONLINE => 'Online',
        self::WALKIN => 'Face to face',
    ];

    public static $statuses = [
        self::PENDING => 'Pending',
        self::APPROVED => 'Requested',
        self::CONFIRMED => 'Confirmed',
        self::COMPLETED => 'Completed',
        self::CANCELLED => 'Cancelled',
        self::EXPIRED => 'Payment Expired',
    ];

    protected $guarded = [];

    protected $appends = ['type_display'];

	protected $dates = [
        'date_time',
        'birthdate',
        'actual_endtime',
        'actual_datetime',
        'payment_expiration'
    ];

    protected $casts = [
        'paid' => 'boolean',
        'custom_fields' => 'array',
        'payment_required' => 'boolean',
        'appt_reminder_sent' => 'boolean',
        'payment_reminder_sent' => 'boolean',
    ];

    protected static function booted()
    {
        static::created(function ($consultation) {
            $doctor = $consultation->doctor;
            $consultationData = array('consultation' => $consultation, 'patient' => $consultation->patient);
            Notification::send($doctor, new Notifications\Consultation(get_class($consultation), 'add', $consultationData));

            $patientName = $consultation->patient->first_name.' '.$consultation->patient->last_name;
            $log = new ConsultationLog;
            $log->fill(array(
                'user_id' => null,
                'consultation_id' => $consultation->id,
                'name' => $patientName,
                'excerpt' => $patientName.' created appointment',
                'text' => $patientName.' created an appointment with reference #'.$consultation->reference_no
            ));
            $log->save();
        });
        static::updated(function ($consultation) {
            if ($consultation->getOriginal('status') != $consultation->status) {
                $log = new ConsultationLog;
                $log->fill(array(
                    'user_id' => auth()->user()->id,
                    'consultation_id' => $consultation->id,
                    'name' => auth()->user()->name,
                    'excerpt' => auth()->user()->name.' updated status from '.$consultation->getOriginal('status').' to '.$consultation->status,
                    'text' => auth()->user()->name.' updated status of an appointment from '.$consultation->getOriginal('status').' to '.$consultation->status .' with reference #'.$consultation->reference_no
                ));
                $log->save();
            }
        });
    }

    /**
     * Relations
     * 
     */

    public function doctor()
    {
    	return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
    	return $this->belongsTo(Patient::class);
    }

    public function logs()
    {
        return $this->hasMany(ConsultationLog::class, 'consultation_id');
    }

    /**
     * Attributes
     * 
     */

    public function getNameAttribute()
    {
        return $this->patient ? $this->patient->first_name.' '.$this->patient->last_name : null;
    }

    public function getFirstNameAttribute()
    {
        return $this->patient ? $this->patient->first_name : null;
    }

    public function getMiddleNameAttribute()
    {
        return $this->patient ? $this->patient->middle_name : null;
    }

    public function getLastNameAttribute()
    {
        return $this->patient ? $this->patient->last_name : null;
    }

    public function getEmailAttribute()
    {
        return $this->patient ? $this->patient->email : null;
    }

    public function getMobileAttribute()
    {
        return $this->patient ? $this->patient->mobile : null;
    }

    public function getTypeDisplayAttribute()
    {
        return self::$types[$this->type] ?? '';
    }

    public function getAgeFormattedAttribute()
    {
        if (!$this->patient->birthdate) return 'n/a';

        return $this->patient->birthdate->age . ' yrs old';
    }

    public function getDoctorFullNameAttribute()
    {
        return $this->doctor ? $this->doctor->first_name.' '.$this->doctor->last_name : null;
    }

    public function getDoctorEmailAttribute()
    {
        return $this->doctor ? $this->doctor->email : null;
    }



    /**
     * Methods
     */

    public function isPending()
    {
        return $this->status == self::PENDING;
    }

    public function isApproved()
    {
        return $this->status == self::APPROVED;
    }

    public function isConfirmed()
    {
        return $this->status == self::CONFIRMED;
    }

    public function isCompleted()
    {
        return $this->status == self::COMPLETED;
    }

    public function isCancelled()
    {
        return $this->status == self::CANCELLED;
    }

    public function isPayable()
    {
        return !$this->paid && !in_array($this->status, [self::PENDING, self::CANCELLED]);
    }

    public function isOnline()
    {
        return $this->type == self::ONLINE;
    }

    // Scope queries
    // ---------------------------------------

    public function scopeConfirmed($query)
    {
        return $query->where('status', self::CONFIRMED);
    }

    public function scopeTimeAlloted($query)
    {
        return $query->whereIn('status', [self::APPROVED, self::CONFIRMED, self::COMPLETED]);
    }

    // Helper methods
    // ---------------------------------------

    public static function generateUniqueRef()
    {
        do {
            $number = mt_rand(1000000, 9999999);
        } while (self::where('reference_no', $number)->exists());

        return $number;
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function getConsultationFee()
    {
        return is_null($this->package) ? (float) $this->consultation_fee : (float) $this->package->price;
    }

}
