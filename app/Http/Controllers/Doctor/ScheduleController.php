<?php

namespace App\Http\Controllers\Doctor;

use App\Leave;
use App\Doctor;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller 
{
	/**
	 * Display list of doctor schedules.
	 * 
	 */
	public function index() 
	{
		$leaves = Leave::get();
		$types = Schedule::$types;

		return view('doctor.schedule', compact('leaves', 'types'));
	}

	/**
	 * Display doctor weekly schedule.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function weekSchedule(Request $request)
	{
		// $doctor = $request->user()->doctor;
		$doctor = $request->user()->isSecretary() ? $request->user()->assignedDoctor : $request->user()->doctor;

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
	 * Create new shift for specified doctor.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function newShift(Request $request)
	{
		// $doctor = $request->user()->doctor;
		$doctor = $request->user()->isSecretary() ? $request->user()->assignedDoctor : $request->user()->doctor;

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
	 * Delete specified shift for specified doctor.
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
	 * Update specified schedule.
	 * 
	 * @param  \App\Schedule  $schedule
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function update(Schedule $schedule, Request $request)
	{
		$inStr = $request->filled('time_in') ? $request->time_in :  Schedule::DEFAULT_TIME_IN;
	    $outStr = $request->filled('time_out') ? $request->time_out : Schedule::DEFAULT_TIME_OUT;

	    $date = $schedule->date;
	    $in = with(new Carbon($inStr))->setDate($date->year, $date->month, $date->day);
	    $out = with(new Carbon($outStr))->setDate($date->year, $date->month, $date->day);

        try {
        	$this->validateTime($schedule->doctor, $in, $out, $date, $schedule);
        } catch (\Exception $e) {
        	return $this->throwJsonError($e->getMessage());
        }

		$schedule->time_in = $request->time_in;
		$schedule->time_out = $request->time_out;
		$schedule->reliever = $request->has('reliever') && $request->reliever;
		$schedule->type = $request->type;
		$schedule->save();

		return $this->weekSchedule($request);
	}

	/**
	 * Set working schedule.
	 * 
	 * @param  \App\Doctor  $doctor
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function setWorking(Doctor $doctor, Request $request)
	{
		$inStr = $request->filled('time_in') ? $request->time_in :  Schedule::DEFAULT_TIME_IN;
	    $outStr = $request->filled('time_out') ? $request->time_out : Schedule::DEFAULT_TIME_OUT;

	    $date = new Carbon($request->date);
		$in = with(new Carbon($inStr))->setDate($date->year, $date->month, $date->day);
	    $out = with(new Carbon($outStr))->setDate($date->year, $date->month, $date->day);

	    try {
        	$this->validateTime($doctor, $in, $out, $date);
        } catch (\Exception $e) {
        	return $this->throwJsonError($e->getMessage());
        }

	    $schedule = new Schedule;
		$schedule->date = $date;
		$schedule->time_in = ($in instanceof Carbon) ? $in->toTimeString() : $in;
		$schedule->time_out = ($out instanceof Carbon) ? $out->toTimeString() : $out;
		$schedule->reliever = $request->has('reliever') && $request->reliever;
		$schedule->leave_id = $request->leave_id;
		$schedule->type = $request->type;

		$doctor->schedules()->save($schedule);

		return $this->weekSchedule($request);
	}

	/**
	 * Validate time.
	 */
	public function validateTime(
		Doctor $doctor, 
		Carbon $in, 
		Carbon $out, 
		Carbon $date = null, 
		Schedule $schedule = null) 
	{
		if ($out <= $in) {
			throw new \Exception('Time out should be greater than time in.');
        }

        if (!$date) return;

		// validate if selected shift overlaps with existing doctor shift
	    $query = $doctor->schedules()->whereDate('date', $date->toDateString());
	    if ($schedule) {
	    	$query = $query->whereNotIn('id', [$schedule->id]);
	    }
	    $shifts = $query->get();

	    if (count($shifts) > 0) {
	    	$overlap = $shifts->first(function($shift) use ($in, $out) {
	    		if ($shift->timeInCarbon() >= $in && $shift->timeInCarbon() <= $out) {
	    			return true;
	    		}
	    		if ($shift->timeOutCarbon() >= $in && $shift->timeOutCarbon() <= $out) {
	    			return true;
	    		}
	    		return false;
	    	});
	    	if ($overlap) {
	    		throw new \Exception('Selected time in-out should not overlap current shift.');
	    	}
	    }
	}

	/**
	 * Update status for specified schedule.
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
	 * Copy weekly schedule.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function weeklyCopySchedule(Request $request)
	{
		// $doctor = $request->user()->doctor;
		$doctor = $request->user()->isSecretary() ? $request->user()->assignedDoctor : $request->user()->doctor;

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
	 * Copy schedule forward.
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
	 * Schedule in week days.
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
	 * Copy schedule of selected weeks.
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