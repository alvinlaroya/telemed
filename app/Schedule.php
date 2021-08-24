<?php

namespace App;

use Arr;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	const DEFAULT_TIME_IN = "08:00:00";
	const DEFAULT_TIME_OUT = "17:00:00";

	const ONLINE = 'online';
    const WALKIN = 'walkin';

    public static $types = [
    	'' => 'Both',
        self::ONLINE => 'Online',
        self::WALKIN => 'Face to face',
    ];

	protected $guarded = [];

    protected $dates = ['date'];

    protected $appends = ['date_time_in', 'date_time_out'];

    protected $casts = [
    	'reliever' => 'boolean',
    ];

    public function doctor()
	{
		return $this->belongsTo(Doctor::class);
	}

	public function leave()
	{
		return $this->belongsTo(Leave::class);
    }

    public function scopeTomorrow($query)
    {
        return $query->whereDate('date', Carbon::tomorrow());
    }

	// Mutators

	public function getDateTimeInAttribute()
	{
		return $this->date->toDateString().' '.$this->time_in;
	}

	public function getDateTimeOutAttribute()
	{
		return $this->date->toDateString().' '.$this->time_out;
	}

	public function getTimeInOutAttribute()
	{
		$timeIn = new Carbon($this->time_in);
		$timeout = new Carbon($this->time_out);

		return $timeIn->format('h:i A').' - '.$timeout->format('h:i A');
	}

	// Helper methods

	public function isWorking()
	{
		return !$this->leave_id;
	}

	public function timeInCarbon()
	{
		return new Carbon($this->date_time_in);
	}

	public function timeOutCarbon()
	{
		return new Carbon($this->date_time_out);
	}

	public static function getAvailableDateByDoctor($doctorId, $column = null, $format = null, $validDate = null)
	{
		$validDate = (isset($validDate)) ? $validDate : now();

		$schedules = self::where('doctor_id', $doctorId)
			->whereDate('date', '>=', $validDate)
			->get();

			$schedulesData = [];

		foreach($schedules as $schedule) {
			$consultationsDateAreFull = (Consultation::where('doctor_id', $doctorId)
				->whereYear('actual_datetime', '>=', $schedule->date->year)
				->whereMonth('actual_datetime', '>=', $schedule->date->month)
				->whereDay('actual_datetime', '>=', $schedule->date->day)
				->where(function($query) use($schedule) {
					$query->whereTime('actual_datetime', '>=', Carbon::parse($schedule->time_in))
						->whereTime('actual_datetime', '<=', Carbon::parse($schedule->time_out));
				})
				->where('status', '!=', 'cancelled')
				->count() > 2) ? true : false;
			
			if($consultationsDateAreFull) {
				continue; // Break the loop, and continue to the next loop
			}

			for(
				$minHour = (int) Carbon::parse($schedule->time_in)->format('H'); 
				$minHour <= Carbon::parse($schedule->time_out)->format('H'); 
				$minHour++
			) {
				
				if(is_null($column)) {
					$schedulesData[] = [
						'id' => $schedule->id,
						'doctorId' => $schedule->doctor_id,
						'date' => $schedule->date->format('Y-m-d'),
						'time' => Carbon::parse($minHour . ':00:00')->toTimeString()
					];
				} else {
					$format = (is_null($format)) ? 'Y-m-d' : $format;

					$schedulesData[] = [
						'date' => $schedule->date->format($format)
					];
				}

			}

		}

		return $schedulesData;
	}

	public static function getAvailableTimeByDoctorAndDate($doctorId, $date, $format = null)
	{
		$schedules = self::where('doctor_id', $doctorId)
			->whereDate('date', $date)
			->get();

		$schedulesData = [];

		foreach($schedules as $schedule) {
			for(
				$minHour = (int) Carbon::parse($schedule->time_in)->format('H'); 
				$minHour <= (int) Carbon::parse($schedule->time_out)->format('H'); 
				$minHour++
			) {

				$isConsulationsScheduleFull = (Consultation::where('doctor_id', $doctorId)
					->whereDate('actual_datetime', $date)
					->where('status', '!=', 'cancelled')
					->whereTime('actual_datetime', Carbon::parse($minHour . ':00:00'))
					->count() > 2) ? true : false;

				if($isConsulationsScheduleFull) {
					continue;
				}

				$schedulesData[] = [
					'time' => Carbon::parse($date . ' ' . $minHour . ':00:00')->format('Y/m/d H:i')
				];

			}

		}

		return $schedulesData;
	}

	public static function getFollowUpDateByDoctor($doctorId, $date)
	{
		$scheduledDate = Carbon::parse($date)->format('Y/m/d');
        $daysAfter = 1;

		$daysAfter = (Doctor::whereHas('schedules', function($query) use($scheduledDate) {
			$query->whereDate('date', $scheduledDate);
		})->count() > 0) ? $daysAfter : 0;

        $availableDates = collect(
			array_unique(
				Arr::flatten(self::getAvailableDateByDoctor($doctorId, 'date', null, $scheduledDate))
			)
		)->sort()->values()->all();

        $followUpDate = null;

        foreach($availableDates as $key => $availableDate) {
            if(str_replace('/', '', $scheduledDate) <= str_replace('-', '', $availableDate)) {
                $followUpDate = (isset($availableDates[$key + $daysAfter])) ? $availableDates[$key + $daysAfter] : null;
                break;
            }
        }

        $scheduleDates = self::getAvailableTimeByDoctorAndDate($doctorId, $followUpDate);
        
		return (count($scheduleDates) > 0) ? $scheduleDates[0]['time'] : null;
	}

}
