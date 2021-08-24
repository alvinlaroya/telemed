<?php

namespace App\Http\Controllers\Admin;

use App\Leave;
use App\Doctor;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller 
{
	/**
	 * Display a list of schedules.
	 */
	public function index() 
	{
		$leaves = Leave::get();
		$doctors = Doctor::with(['schedules'])->get();

		return view('admin.schedules', compact('doctors', 'leaves'));
	}

	/**
	 * Display a list of daily schedule.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function dailySchedule(Request $request)
	{
		$checkDate = new Carbon($request->date);
		$with = [
			'schedules' => function($query) use ($checkDate) {
                $query->whereDate('date', $checkDate->toDateString());
            },
            'schedules.leave'
		];
		return Doctor::with($with)->get();
	}

	/**
	 * Display a list of weekly schedules.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function weekSchedules(Request $request)
	{
		$endDate = new Carbon($request->end_date);
        $startDate = new Carbon($request->start_date);
		$with = [
			'schedules' => function($query) use ($startDate, $endDate) {
                $query->whereDate('date', '>=', $startDate->toDateString())
                      ->whereDate('date', '<=', $endDate->toDateString());
            },
            'schedules.leave'
		];
		return Doctor::with($with)->get();
	}

	/**
	 * Update the specified schedule.
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

		return $this->weekSchedules($request);
	}

	/**
	 * Update status of specified schedule.
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

		if ($request->has('daily')) {
			return $this->dailySchedule($request);
		}

		return $this->weekSchedules($request);
	}

	/**
	 * Set working hours for specified doctor.
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

		return $this->weekSchedules($request);
	}

	/**
	 * Save bulk daily schedule.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function saveSchedule(Request $request)
	{
		$checkouts = (array) $request->checkouts;
		$checkins = (array) $request->checkins;
		$leaves = (array) $request->leaves;
		$doctors = (array) $request->doctors;
		$date = new Carbon($request->date);

		$schedules = [];
		foreach ($doctors as $key => $doctorId) {
			if (!isset($checkins[$doctorId]) || !isset($checkouts[$doctorId])) {
				continue;
			}
			$doctor = Doctor::find($doctorId);
			$leaveId = isset($leaves[$doctorId]) ? $leaves[$doctorId] : null;
			$schedule = $this->scheduleExistThenUpdate($doctor, $date, $checkins[$doctorId], $checkouts[$doctorId], $leaveId);
			if ($schedule) {
				$schedules[] = $schedule;
			}
		}

		return $this->dailySchedule($request);
	}

	/**
	 * Check if schedule exist then update.
	 * 
	 * @param  \App\Doctor  $doctor
	 * @param  \Carbon\Carbon  $date
	 */
	public function scheduleExistThenUpdate(Doctor $doctor, Carbon $date, $timeIn, $timeOut, $leaveId = null) 
	{
		$schedule = $doctor->schedules->first(function($schedule) use ($date) {
			return $date->isSameDay($schedule->date);
		});

		if (!$schedule) return false;

        $in = new Carbon($timeIn);
        $out = new Carbon($timeOut);

		$schedule->time_in = $timeIn;
		$schedule->time_out = $timeOut;
		$schedule->leave_id = $leaveId;

		return tap($schedule)->save();
	}

	/**
	 * Copy weekly schedule for specified doctors.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function weeklyCopySchedule(Request $request)
	{
		$weekCopy = new Carbon($request->week_copy);
		$copyType = $request->copy_type;
		$doctors = (array) $request->doctors;

		if ($copyType == 'weeks_forward') {
			$numWeeks = (int) $request->num_weeks;
			foreach ($doctors as $doctorId) {
				$doctor = Doctor::find($doctorId);
				$this->copyScheduleForward($doctor, $weekCopy, $numWeeks);
			}
		} else if ($copyType == 'selected_weeks') {
			$copyToWeeks = (array) $request->on_weeks;
			foreach ($doctors as $doctorId) {
				$doctor = Doctor::find($doctorId);
				$this->copyScheduleOnSelectedWeeks($doctor, $weekCopy, $copyToWeeks);
			}
		} else {
			// nah
		}

		return $this->weekSchedules($request);
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

		do {
		    $deputation = null;
            
            if (!isset($schedulesCopy[$runningDate->dayOfWeek]) || !$schedulesCopy[$runningDate->dayOfWeek]) {
                $runningDate->addDay();
                continue;
            }

            $schedule = $this->findOrNew($doctor, $runningDate);
            if ($schedulesCopy[$runningDate->dayOfWeek]) {
                $modelSchedule = $schedulesCopy[$runningDate->dayOfWeek];

                $schedule->time_in = $modelSchedule->time_in;
                $schedule->time_out = $modelSchedule->time_out;
                $schedule->leave_id = $modelSchedule->leave_id;
                $schedules[] = $schedule;
            }

			$runningDate->addDay();
		} while ($runningDate <= $endCopy);

		if (count($schedules) > 0) {
			$schedules = $doctor->schedules()->saveMany($schedules);

			return $schedules;
		}
	}

	/**
	 * Copy schedule on selected weeks.
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

			do {
                if (!isset($schedulesCopy[$runningDate->dayOfWeek]) || !$schedulesCopy[$runningDate->dayOfWeek]) {
                    $runningDate->addDay();
                    continue;
                }

                $schedule = $this->findOrNew($doctor, $runningDate);
                if ($schedulesCopy[$runningDate->dayOfWeek]) {
                    $modelSchedule = $schedulesCopy[$runningDate->dayOfWeek];

                    $schedule->time_in = $modelSchedule->time_in;
                    $schedule->time_out = $modelSchedule->time_out;
                    $schedule->leave_id = $modelSchedule->leave_id;
                    $schedules[] = $schedule;
                }

				$runningDate->addDay();
			} while ($runningDate <= $endCopy);
		}

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
			$schedules[$runningDate->dayOfWeek] = $doctor->schedules->first(function($schedule) use ($runningDate){
				return $runningDate->isSameDay($schedule->date);
			});
			$runningDate->addDay();
			$day++;
		} while ($day <= 7);

		return $schedules;
	}

	/**
	 * Find schedule for specified doctor.
	 * 
	 * @param  \App\Doctor  $doctor
	 * @param  \Carbon\Carbon  $date
	 */
	public function findOrNew(Doctor $doctor, Carbon $date)
	{
		$schedule = $doctor->schedules->first(function($schedule) use ($date) {
			return $date->isSameDay($schedule->date);
		});

		if ($schedule) return $schedule;

		return new Schedule([
			'doctor_id' => $doctor->id, 
			'date' => $date->toDateString(), 
		]);
	}

    /**
	 * Daily Bulk Copy Schedule 
	 * 
	 * @param  Illuminate\Http\Request $request
	 */
	public function dailyCopySchedule(Request $request) 
	{
		$numDays = (int) $request->num_days;
		if (0 == $numDays) return;
		
		$schedules = $this->dailyBulkUpdateOrCreate($request);

		foreach ($schedules as $schedule) {
			$this->copyScheduleForDays($schedule, $numDays);
		}

		return $this->dailySchedule($request);
	}

	/**
	 * Copy Schedule For Days 
	 * 
	 * @param  Schedule $schedule
	 * @param  int   $numDays
	 */
	public function copyScheduleForDays(Schedule $schedule, $numDays) 
	{
		$runningDate = $schedule->date;
		$endDate = $schedule->date->addDays($numDays);
		$doctor = $schedule->doctor;

		do {
			$this->updateOrCreateSchedule($doctor, $runningDate, $schedule->time_in, $schedule->time_out, $schedule->leave_id);
			$runningDate->addDay();
		} while ($runningDate <= $endDate);
	}

	/**
	 * Update Or Create Schedule 
	 * 
	 * @param  Doctor $doctor 
	 * @param  Carbon   $date     
	 * @param  time   $timeIn   
	 * @param  time   $timeOut
	 */
	public function updateOrCreateSchedule(Doctor $doctor, Carbon $date, $timeIn, $timeOut, $leaveId = null) 
	{
		if (!$schedule = $this->scheduleExistThenUpdate($doctor, $date, $timeIn, $timeOut, $leaveId)) {
            $schedule = new Schedule([
				'date' => $date->toDateString(),
				'time_in' => $timeIn,
				'time_out' => $timeOut,
				'leave_id' => $leaveId,
			]);
			$doctor->schedules()->save($schedule);
		}
		
		return $schedule;
	}

	/**
	 * Bulk Update or Create employee schedule
	 * 
	 * @param  Request $request
	 */
	public function dailyBulkUpdateOrCreate(Request $request)
	{
		$checkouts = (array) $request->checkouts;
		$checkins = (array) $request->checkins;
		$leaves = (array) $request->leaves;
		$doctors = (array) $request->doctors;
		$date = new Carbon($request->date);

		$schedules = [];
		foreach ($doctors as $key => $doctorId) {
			if (!isset($checkins[$doctorId]) || !isset($checkouts[$doctorId])) {
				continue;
			}
			$doctor = Doctor::find($doctorId);
			$leaveId = isset($leaves[$doctorId]) ? $leaves[$doctorId] : null;
			$schedule = $this->scheduleExistThenUpdate($doctor, $date, $checkins[$doctorId], $checkouts[$doctorId], $leaveId);
			if ($schedule) {
				$schedules[] = $schedule;
			}
		}

		return $schedules;
	}

	/**
     * Bulk Update Status
     *
     * @param  Illuminate\Http\Request $request
     */
    public function bulkUpdateStatus(Request $request)
    {
        $doctors = (array) $request->doctors;
        $date = new Carbon($request->date);
        $in = Schedule::DEFAULT_TIME_IN;
        $out = Schedule::DEFAULT_TIME_OUT;
        
        $leave = $request->filled('leave_id') ? Leave::find($request->leave_id) : null;

        foreach ($doctors as $doctorId) {
            $schedule = Schedule::firstOrNew([
                'doctor_id' => $doctorId,
                'date' => $date->toDateString(),
            ]);

            $schedule->time_in = $in;
            $schedule->time_out = $out;
            $schedule->leave_id = $leave ? $leave->id : null;
            $schedule->save();
        }

        return $this->dailySchedule($request);
    }

}