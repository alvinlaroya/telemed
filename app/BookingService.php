<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    const PENDING = 'pending';
	const APPROVED = 'approved';
	const CONFIRMED = 'confirmed';
	const COMPLETED = 'completed';
	const CANCELLED = 'cancelled';
    const EXPIRED = 'expired';

    protected $guarded = [];

    /**
     * Relations
     * 
     */

    public function service()
    {
    	return $this->belongsTo(Service::class, 'service_id');
    }

    public function bookingCenter()
    {
    	return $this->belongsTo(BookingCenter::class);
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

    public function isCancellable()
    {
        return !in_array($this->status, [self::CANCELLED, self::COMPLETED]);
    }

    protected static function booted()
    {
        static::updated(function ($bService) {
            if ($bService->getOriginal('status') !== $bService->status) {
                $msg = auth()->user()->name
                        .' updated status'
                        .' of '.$bService->service->name.' from '
                        .$bService->getOriginal('status')
                        .' to '.$bService->status;

                if ($bService->status == self::CANCELLED) {
                    $msg .= ' with remarks '.$bService->remarks;
                }
                $log = new BookingLog;
                $log->fill(array(
                    'user_id' => auth()->user()->id,
                    'booking_center_id' => $bService->booking_center_id,
                    'booking_service_id' => $bService->id,
                    'name' => auth()->user()->name,
                    'excerpt' => $msg,
                ));
                $log->save();
            }
        });
    }

}
