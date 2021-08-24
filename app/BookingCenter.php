<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BookingCenter extends Model
{
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const CONFIRMED = 'confirmed';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancelled';
    const EXPIRED = 'expired';

    const PAYMENT_PENDING = 'pending';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_CANCELLED = 'cancelled';

    public static $statuses = [
        self::PENDING => 'Pending',
        self::APPROVED => 'Approved',
        self::CONFIRMED => 'Confirmed',
        self::COMPLETED => 'Completed',
        self::CANCELLED => 'Cancelled',
        self::EXPIRED => 'Payment Expired',
    ];

    public static $paymentStatuses = [
        self::PAYMENT_PENDING => 'Pending',
        self::PAYMENT_PAID => 'Paid',
        self::PAYMENT_PAID => 'Cancelled'
    ];

    protected $dates = [
        'preferred_date',
        'available_date',
        'paid_at',
    ];

    protected $casts = [
        'custom_fields' => 'array',
        'reminder_sent' => 'boolean',
        'other_data' => 'array',
    ];

    protected $guarded = [];

    /**
     * Relations
     * 
     */

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function service()
    {
    	return $this->belongsTo(Service::class, 'service_id');
    }

    public function bookingServices()
    {
    	return $this->hasMany(BookingService::class, 'booking_center_id');
    }

    public function serviceCenter()
    {
    	return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function logs()
    {
        return $this->hasMany(BookingLog::class);
    }

    /**
     * Methods
     */

    public function isWithin5Days()
    {
        $screening = $this->booking->patient->screenings()->latest()->first();
        $screeningDate = $screening ? $screening->created_at->modify('+4 days')->format('Y-m-d') : null;

        if($this->available_date && $screeningDate) {
            if($this->available_date->format('Y-m-d') <= $screeningDate && $this->available_date->format('Y-m-d') >= Carbon::now()->format('Y-m-d')) {
                return true;
            }
        }
        return false;
    }

    // Getters Attributes

    public function getStatusFormattedAttribute()
    {
        return self::$statuses[$this->status] ?? ucfirst($this->status ?? $this->booking->status);
    }

    public function getAvailableDateTimeAttribute()
    {
        if ($this->available_time) {
            return $this->available_date->format('M-j-Y h:i A');
        } elseif($this->available_date) {
            return $this->available_date->format('M-j-Y');
        }

        return null;
    }

    public function getCenterTotalAmountAttribute()
    {
        $total = 0;
        foreach($this->bookingServices as $key => $bookingService) {
            if($bookingService->status != self::CANCELLED) {
                $total = $total + $bookingService->service->price;
            }
        }

        return $total;
    }

    public function isPaid()
    {
        return $this->payment_status == self::PAYMENT_PAID;
    }

    public function getCenterDiscountAttribute()
    {
        if (!$this->booking->patient->pwd_senior) return 0;

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

    public function getCenterDiscountedTotalAmountAttribute()
    {
        $total = $this->center_total_amount;
        $discount = $this->center_discount;
        $total = $total - $discount;
        return $total;
    }

    public function getNumberOfApprovedAttribute()
    {
        $approved = 0;

        if($this->bookingServices) {
            foreach($this->bookingServices as $bookingService) {
                if($bookingService->status == Booking::APPROVED || $bookingService->status == Booking::CONFIRMED) {
                    $approved++;
                }
            }
        }

        return $approved;
    }

    // Scope queries
    // ---------------------------------------

    public function scopeOfCenter($query, ServiceCategory $center)
    {
        return $query->where('service_category_id', $center->id);
    }

    public function scopeOfCenters($query, $centers)
    {
        return $query->whereIn('service_category_id', $centers);
    }

    public function scopeNotOfCenter($query, ServiceCategory $center)
    {
        return $query->where('service_category_id', '!=', $center->id);
    }

    public function scopeNotOfCenters($query, $center)
    {
        return $query->whereNotIn('service_category_id', $center);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', self::CONFIRMED);
    }

    protected static function booted()
    {
        static::updated(function ($bCenter) {
            if ($bCenter->getOriginal('available_date') != $bCenter->available_date) {
                $log = new BookingLog;
                $msg = auth()->user()->name
                        .' updated available date from '.$bCenter->getOriginal('available_date')
                        .' to '.$bCenter->available_date;
                if ($bCenter->getOriginal('remarks') !== $bCenter->remarks) {
                    $msg .= ' with remarks '. $bCenter->remarks;
                }
                $log->fill(array(
                    'user_id' => auth()->user()->id,
                    'booking_center_id' => $bCenter->id,
                    'name' => auth()->user()->name,
                    'excerpt' => $msg,
                ));
                $bCenter->logs()->save($log);
            } else if ($bCenter->getOriginal('remarks') !== $bCenter->remarks) {
                if (empty($bCenter->getOriginal('remarks'))) {
                    $msg = auth()->user()->name.' added remarks '.$bCenter->remarks;
                } else {
                    $msg = auth()->user()->name.' updated remarks to '.$bCenter->remarks;
                }
                $log = new BookingLog;
                $log->fill(array(
                    'user_id' => auth()->user()->id,
                    'booking_center_id' => $bCenter->id,
                    'name' => auth()->user()->name,
                    'excerpt' => $msg,
                ));
                $bCenter->logs()->save($log);
            }
        });
    }
}
