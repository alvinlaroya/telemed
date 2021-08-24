<?php

namespace App\Http\Controllers\Admin;

use App\Leave;
use App\Doctor;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DoctorScheduleController extends Controller 
{
	/**
	 * List the schedules for specified doctor.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function weekSchedule(Request $request)
	{
		$doctor = $request->user()->doctor;

		$endDate = new Carbon($request->end_date);
        $startDate = new Carbon($request->start_date);
        $values = Schedule::with(['leave'])
	        	->whereDate('date', '>=', $startDate->toDateString())
	            ->whereDate('date', '<=', $endDate->toDateString())
	            ->where('doctor_id', $doctor->id)
	            ->get();

		return $values;
	}

	/**
	 * Create a new shift for specified doctor.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function newShift(Request $request)
	{
		$doctor = $request->user()->doctor;

        $schedule = new Schedule;
		$schedule->date = new Carbon($request->date);

		$in = $request->filled('time_in') ? new Carbon($request->time_in) :  Schedule::DEFAULT_TIME_IN;
	    $out = $request->filled('time_out') ? new Carbon($request->time_out) : Schedule::DEFAULT_TIME_OUT;

		$schedule->time_in = ($in instanceof Carbon) ? $in->toTimeString() : $in;
		$schedule->time_out = ($out instanceof Carbon) ? $out->toTimeString() : $out;

		$doctor->schedules()->save($schedule);

		return $this->weekSchedule($request);
	}

	/**
	 * Remove specified shift for specified doctor.
	 * 
	 * @param  \App\Schedule  $schedule
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function deleteShift(Schedule $schedule, Request $request)
	{
		$schedule->delete();

		return $this->weekSchedule($request);
	}

	/**
	 * Update schedule for a specified doctor.
	 * 
	 * @param  \App\Schedule  $schedule
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function update(Schedule $schedule, Request $request)
	{
        $in = $request->filled('time_in') ? new Carbon($request->time_in) : null;
        $out = $request->filled('time_out') ? new Carbon($request->time_out) : null;

		$schedule->time_in = $request->time_in;
		$schedule->time_out = $request->time_out;
		$schedule->save();

		return $this->weekSchedule($request);
	}

	/**
	 * Set as working shift for specified doctor.
	 * 
	 * @param  \App\Doctor  $doctor
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function setWorking(Doctor $doctor, Request $request)
	{
		$schedule = new Schedule;
		$schedule->date = new Carbon($request->date);

		$in = $request->filled('time_in') ? new Carbon($request->time_in) :  Schedule::DEFAULT_TIME_IN;
	    $out = $request->filled('time_out') ? new Carbon($request->time_out) : Schedule::DEFAULT_TIME_OUT;

		$schedule->time_in = ($in instanceof Carbon) ? $in->toTimeString() : $in;
		$schedule->time_out = ($out instanceof Carbon) ? $out->toTimeString() : $out;
		$schedule->leave_id = $request->leave_id;

		$doctor->schedules()->save($schedule);

		return $this->weekSchedule($request);
	}

	/**
	 * Update status of schedule for specified doctor.
	 * 
	 * @param  \App\Schedule  $schedule
	 * @param  \App\Leave  $leave
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function updateStatus(Schedule $schedule, Leave $leave = null, Request $request) 
	{
		if (!$leave) {
			$schedule->leave_id = null;
		} else {
			$schedule->leave()->associate($leave);
		}

		$schedule->save();

		// if ($request->has('daily')) {
		// 	return $this->dailySchedule($request);
		// }

		return $this->weekSchedule($request);
	}

	/**
	 * Copy weekly schedule for specified doctor.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function weeklyCopySchedule(Request $request)
	{
		$doctor = $request->user()->doctor;

		$weekCopy = new Carbon($request->week_copy);
		$copyType = $request->copy_type;

		if ($copyType == 'weeks_forward') {
			$numWeeks = (int) $request->num_weeks;
			$this->copyScheduleForward($doctor, $weekCopy, $numWeeks);
		} else if ($copyType == 'selected_weeks') {
			$copyToWeeks = (array) $request->on_weeks;
			$this->copyScheduleOnSelectedWeeks($doctor, $weekCopy, $copyToWeeks);
		} else {
			// nah
		}

		return $this->weekSchedule($request);
	}

	/**
	 * Copy schedule forward for specified doctor.
	 * 
	 * @param  \App\Doctor  $doctor
	 * @param  \Carbon\Carbon  $weekStart
	 */
	public function copyScheduleForward(Doctor $doctor, Carbon $weekStart, $weeksForward)
	{
		$schedulesCopy = $this->scheduleInWeekDays($doctor, $weekStart);
		$startString = $weekStart->toDateString();
		$runningDate = (new Carbon($startString))->addWeek();
		$endCopy = (new Carbon($startString))->addWeeks($weeksForward+1)->endOfWeek();
		$schedules = [];

		// delete first doctor schedules for the given date range
		$doctor->schedules()
			   ->whereDate('date', '>=', $runningDate->toDateString())
			   ->whereDate('date', '<=', $endCopy->toDateString())
			   ->delete();

		do {            
			$daySchedules = $schedulesCopy[$runningDate->dayOfWeek] ?? [];
            if (count($daySchedules) == 0) {
                $runningDate->addDay();
                continue;
            }

            foreach ($daySchedules as $shift) {
            	$sched = $shift->replicate();
            	$sched->time_in = $shift->time_in;
                $sched->time_out = $shift->time_out;
                $sched->leave_id = $shift->leave_id;
                $sched->date = $runningDate->toDateString();
                $schedules[] = $sched;
            }
			$runningDate->addDay();
		} while ($runningDate <= $endCopy);

		if (count($schedules) > 0) {
			$schedules = $doctor->schedules()->saveMany($schedules);

			return $schedules;
		}
	}

	/**
	 * Schedule weekdays for speficied doctor.
	 * 
	 * @param  \App\Doctor  $doctor
	 * @param  \Carbon\Carbon  $startWeek
	 */
	protected function scheduleInWeekDays(Doctor $doctor, Carbon $startWeek) 
	{
		$day = 1;
		$schedules = [];
		$runningDate = new Carbon($startWeek->toDateString());

		do {
			$schedules[$runningDate->dayOfWeek] = $doctor->schedules->filter(function($schedule) 
				use ($runningDate) {
				return $runningDate->isSameDay($schedule->date);
			});
			$runningDate->addDay();
			$day++;
		} while ($day <= 7);

		return $schedules;
	}

	/**
	 * Copy schedule of selected weeks for specified doctor.
	 * 
	 * @param  \App\Doctor  $doctor
	 * @param  \Carbon\Carbon  $weekToCopy
	 */
	public function copyScheduleOnSelectedWeeks(Doctor $doctor, Carbon $weekToCopy, $onWeeks)
	{
		$schedulesCopy = $this->scheduleInWeekDays($doctor, $weekToCopy);
		$startString = $weekToCopy->toDateString();
		$schedules = [];

		foreach ($onWeeks as $startOfWeek) {
			$runningDate = new Carbon($startOfWeek);
			$endCopy = (new Carbon($startOfWeek))->addDays(6);

			// delete first doctor schedules for the given date range
			$doctor->schedules()
				   ->whereDate('date', '>=', $runningDate->toDateString())
				   ->whereDate('date', '<=', $endCopy->toDateString())
				   ->delete();

			do {
				$daySchedules = $schedulesCopy[$runningDate->dayOfWeek] ?? [];
	            if (count($daySchedules) == 0) {
	                $runningDate->addDay();
	                continue;
	            }

	            foreach ($daySchedules as $shift) {
	            	$sched = $shift->replicate();
	            	$sched->time_in = $shift->time_in;
	                $sched->time_out = $shift->time_out;
	                $sched->leave_id = $shift->leave_id;
	                $sched->date = $runningDate->toDateString();
	                $schedules[] = $sched;
	            }

				$runningDate->addDay();
			} while ($runningDate <= $endCopy);
		}

		if (count($schedules) > 0) {
			$schedules = $doctor->schedules()->saveMany($schedules);
			return $schedules;
		}
	}

}