<?php

namespace App;

use Carbon\Carbon;
use App\BookingCenter;
use App\PatientScreening;
use App\Jobs\ProcessSmsSending;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Booking extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

	const PENDING = 'pending';
	const APPROVED = 'approved';
	const PAID = 'paid';
	const CONFIRMED = 'confirmed';
	const COMPLETED = 'completed';
	const CANCELLED = 'cancelled';
    const ONHOLD = 'onhold';
    const EXPIRED = 'expired';
    const PARTIALLY_PAID = 'partially_paid';

    const CREDITCARD = 'credit_card';
    const HMO = 'hmo';
    const CORPORATE = 'corporate';
    const INSURANCE = 'insurance';
    const MMCEMPLOYEE = 'mmc_employee';

    public static $statuses = [
        self::PENDING => 'Pending',
        self::APPROVED => 'Approved',
        self::CONFIRMED => 'Confirmed',
        self::COMPLETED => 'Completed',
        self::CANCELLED => 'Cancelled',
        self::EXPIRED => 'Payment Expired',
        self::ONHOLD => 'On Hold',
        self::PARTIALLY_PAID => 'Partially Paid',
    ];

    protected $guarded = [];

    protected $casts = [
        'other_data' => 'array',
        'custom_fields' => 'array',
        'payment_reminder_sent' => 'boolean',
    ];

    protected $dates = [
        'preferred_date',
        'expiration',
        'paid_at',
        'available_date',
    ];

    public function centerUsers()
    {
        $this->load(['bookingCenters.serviceCenter.users']);
        $users = array();
        foreach( $this->bookingCenters as $center) {
            // $users[] = $center->serviceCenter->users;
            if(count((array) $center->serviceCenter->users) > 0){
                foreach($center->serviceCenter->users as $user){
                    if(!collect($users)->contains('id', $user->id)){
                        $users[] = $user;
                    }
                }
            }
        }
        return collect($users);
    }

    protected static function booted()
    {
        static::created(function ($booking) {
            // Log
            $patientName = $booking->patient->first_name.' '.$booking->patient->last_name;
            $log = new BookingLog;
            $log->fill(array(
                'user_id' => null,
                'booking_id' => $booking->id,
                'name' => $patientName,
                'excerpt' => $patientName.' created booking',
                'text' => $patientName.' created booking with reference #'.$booking->booking_reference_no
            ));
            $log->save();
        });
        static::updated(function ($booking) {
            // $users = $booking->centerUsers();
            // $bookingData = array('booking' => $booking, 'patient' => $booking->patient);
            // if ($booking->status == 'paid' || $booking->status == 'cancelled'){
            //     Notification::send($users, new Notifications\Booking(get_class($booking), 'edit', $bookingData));
            // }
        });
    }

    /**
     * Relations
     *
     */

    public function service()
    {
    	return $this->belongsTo(Service::class);
    }

    public function patient()
    {
    	return $this->belongsTo(Patient::class);
    }

    public function bookingServices()
    {
    	return $this->hasMany(BookingService::class);
    }

    public function bookingCenters()
    {
    	return $this->hasMany(BookingCenter::class);
    }

    public function logs()
    {
        return $this->hasMany(BookingLog::class);
    }

    /**
     * Attributes
     */

    public function getNameAttribute()
    {
    	return $this->middle_name ? $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name : $this->first_name .' '. $this->last_name;
    }

    public function getTotalAmountAttribute()
    {
        $total = 0;
        foreach($this->bookingServices as $key => $bookingService) {
            if($bookingService->status != self::CANCELLED) {
                if(isset($bookingService->service->price)) {
                    $total = $total + $bookingService->service->price;
                } else {
                    $total = $total;
                }
            }
        }

        return $total;
    }

    public function getTotalAmountV2Attribute()
    {
        $total = 0;
        foreach($this->bookingCenters as $centerKey => $bookingCenter) {
            if($bookingCenter->isWithin5Days()) {
                foreach($bookingCenter->bookingServices as $key => $bookingService) {
                    if($bookingService->status != self::CANCELLED) {
                        $total = $total + $bookingService->service->price;
                    }
                }
            }
        }
        return $total;
    }

    public function getDiscountAttribute()
    {
        if (!$this->patient->pwd_senior) return 0;

        $discount = 0;
        foreach($this->bookingServices as $key => $bookingService) {
            if($bookingService->status != self::CANCELLED) {
                if($bookingService->service->eligible) {
                    $tmpDiscount = $bookingService->service->price * 0.2;
                    $discount = $discount + $tmpDiscount;
                }
            }
        }

        return $discount;
    }

    public function getDiscountV2Attribute()
    {
        if (!$this->patient->pwd_senior) return 0;

        $discount = 0;
        foreach($this->bookingCenters as $centerKey => $bookingCenter) {
            if($bookingCenter->isWithin5Days()) {
                foreach($bookingCenter->bookingServices as $key => $bookingService) {
                    if($bookingService->status != self::CANCELLED) {
                        if($bookingService->service->eligible) {
                            $tmpDiscount = $bookingService->service->price * 0.2;
                            $discount = $discount + $tmpDiscount;
                        }
                    }
                }
            }
        }

        return $discount;
    }

    public function getDiscountedTotalAmountAttribute()
    {
        $total = $this->total_amount;
        $discount = $this->discount;

        if($this->patient->pwd_senior == 1) {
            $total = $total - $discount;
        }
        return $total;
    }

    public function getDiscountedTotalAmountV2Attribute()
    {
        $total = $this->total_amount_v2;
        $discount = $this->discount_v2;

        if($this->patient->pwd_senior == 1) {
            $total = $total - $discount;
        }
        return $total;
    }

    public function getScheduleDateAttribute()
    {
        return ($this->available_date) ? $this->available_date : $this->preferred_date;
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

    public function isPaid()
    {
        return $this->status == self::PAID;
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

    public function hasAfter5days()
    {
        $screening = $this->patient->screenings()->latest()->first();
        $screeningDate = $screening->created_at->modify('+4 days')->format('Y-m-d');
        foreach($this->bookingCenters as $key => $bookingCenter) {
            if($bookingCenter->available_date->format('Y-m-d') > $screeningDate) {
                return true;
            }
        }
        return false;
    }

    public function allCentersAreAfter5Days()
    {
        $screening = $this->patient->screenings()->latest()->first();
        $screeningDate = $screening->created_at->modify('+4 days')->format('Y-m-d');
        $areAfter5daysCount = 0;
        foreach($this->bookingCenters as $key => $bookingCenter) {
            if($bookingCenter->available_date->format('Y-m-d') > $screeningDate) {
                $areAfter5daysCount++;
            }
        }
        return $this->bookingCenters->count() == $areAfter5daysCount ? true : false;
    }

    // Scope queries
    // ---------------------------------------

    public function scopeApproved($query)
    {
        return $query->where('status', self::APPROVED);
    }

    public function scopeOfCenter($query, ServiceCategory $center)
    {
        return $query->whereHas('bookingCenters', function($q) use ($center) {
            $q->where('service_category_id', $center->id);
        });
    }

    public function scopeOfCenters($query, $centers)
    {
        return $query->whereHas('bookingCenters', function($q) use ($centers) {
            $q->whereIn('service_category_id', $centers);
        });
    }

    public static function generateUniqueBookingRef()
    {
        
        do {
            $number = mt_rand(1000000, 9999999);
        } while (self::where('booking_reference_no', $number)->exists());

        return $number;
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

}
