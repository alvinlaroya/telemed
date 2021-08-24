<?php

namespace App\Http\Livewire;

use App\Doctor;
use App\Schedule;
use App\Consultation;
use App\Specialization;
use Livewire\Component;
use App\HmoAccreditation;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DoctorSearch extends Component
{
    public $hmo;
    public $date;
    public $hmoId;
    public $alpha;
    public $gender;
    public $doctorId;
    public $filterClinicDays = [
        'Mon' => false,
        'Tue' => false,
        'Wed' => false,
        'Thu' => false,
        'Fri' => false,
        'Sat' => false,
        'Sun' => false,
    ];
    public $specializationId;
    public $search = '';
    public $limit = 12;

    // protected $casts = [
    //     'filterClinicDays' => 'array',
    // ];

    protected $listeners = ['dateSelected', 'timeSelected', 'clearSelected', 'resetDate'];

    public function mount()
    {
        if (session()->has('doctor')) {
            $this->doctorId = session('doctor');
        }
    }

    public function resetSearch()
    {
        $this->reset();
    }

    public function resetDate()
    {
        $this->selectDoctor($this->doctorId);
    }

    public function selectDoctor($doctorId)
    {
        $this->doctorId = $doctorId;
        session(['doctor' => $doctorId]);
        $doctor = Doctor::with([
            'schedules' => function($q) {
                $q->whereDate('date', '>=', today()->toDateString())
                  ->whereDate('date', '<', today()->addDays(62)->toDateString());
            }
        ])->find($doctorId);
        $enable = $doctor->schedules->filter(function($sched) {
                return !$sched->leave_id;
            })
            ->map(function($sched) {
                $date = $sched->date;
                return [$date->year, $date->month - 1, $date->day];
            })
            ->unique()
            ->values()->toArray();

        $this->emit('datePickerData', [
            'dates' => $enable,
            'minsInterval' => $doctor->consultation_duration,
        ]);
        $this->emit('doctorSelected', [
            'id' => $doctor->id,
            'name' => $doctor->display_name,
            'full_name' => $doctor->full_name,
            'img' => $doctor->getFirstMediaUrl('avatar'),
            'specializations' => $doctor->specializations_formatted,
        ]);
    }

    public function clearSelected()
    {
        $this->doctorId = null;
        session()->forget('doctor');
    }

    public function dateSelected($param)
    {
        if (!$param) return;

        $today = now()->addMinutes(30);
        $carbon = new Carbon($param);
        $this->date = $carbon->toDateString();
        $doctor = Doctor::find($this->doctorId);
        $duration = $doctor->consultation_duration ?? 10;
        $shifts = Schedule::where('doctor_id', $this->doctorId)
                    ->whereDate('date', $this->date)
                    ->get();
        
        $shiftsArr = $shifts->map(function($shift) use ($duration) {
                        return [
                            'from' => $shift->timeInCarbon(),
                            'to' => $shift->timeOutCarbon()->subMinutes($duration),
                        ];
                    })
                    ->reject(function($shift) use ($today) {
                        return $today->greaterThanOrEqualTo($shift['to']);
                    })
                    ->toArray();

        if ($carbon->isToday()) {
            $todayShift = Arr::first($shiftsArr, function ($shift, $key) use ($today) {
                return $today >= $shift['from'] && $today < $shift['to'];
            });
            if ($todayShift) {
                $index = array_search($todayShift, $shiftsArr);
                $shiftsArr[$index]['from'] = $today->copy();
            }
        }

        $appointments = Consultation::timeAlloted()
                            ->whereDate('actual_datetime', $this->date)
                            ->where('doctor_id', $this->doctorId)
                            ->get();

        $this->formulateNewShifts($appointments, $shiftsArr, $duration);

        $data = array_map(function($shift) {
            $shift['from'] = [$shift['from']->format('G'), $shift['from']->format('i')];
            $shift['to'] = [$shift['to']->format('G'), $shift['to']->format('i')];
            return $shift;
        }, $shiftsArr);

        // get min and max enable time
        $sorted = $shifts->sortBy('date_time_in');
        $min = $sorted->first()->timeInCarbon();
        $max = $sorted->last()->timeOutCarbon();

        $reliever = $shifts->first->reliever;
        // $notReliever = $shifts->first(function($s) {
        //     return !$s->reliever;
        // });

        $consultations = Consultation::whereDate('actual_datetime', $min->format('Y-m-d'))
            ->whereNotIn('status', ['cancelled'])
            ->select('actual_datetime')
            ->get();

        $getDateTime = function($date, $param) {
            return (int) $date->format($param);
        };

        $disabledDateTimes = [];

        if(count($consultations) > 2) {
            foreach($consultations as $consultation) {
                $disabledDateTimes[] = [
                    $getDateTime($consultation->actual_datetime, 'Y'),
                    $getDateTime($consultation->actual_datetime, 'd'),
                    $getDateTime($consultation->actual_datetime, 'm'),
                    $getDateTime($consultation->actual_datetime, 'H')
                ];
            }
        }

        $disabledDateTimesFormatted = collect($disabledDateTimes)->unique()->values()->all();

        $this->emit('enableTime', [
            'reliever' => $reliever,
            'min' => [$min->format('G'), $min->format('i')],
            'max' => [$max->format('G'), $max->format('i')],
            'enable' => array_values($data),
            'disable' => $disabledDateTimesFormatted
        ]);
    }

    public function timeSelected($time)
    {
        $date = new Carbon($this->date);
        $dateTime = with(new Carbon($time))->setDate($date->year, $date->month, $date->day);

        $doctor = Doctor::find($this->doctorId);
        $shifts = Schedule::where('doctor_id', $this->doctorId)
                    ->whereDate('date', $this->date)
                    ->get();

        $inShift = $shifts->first(function($s) use ($dateTime) {
            return $dateTime >= $s->timeInCarbon() && $dateTime <= $s->timeOutCarbon();
        });

        if ($inShift) {
            $this->emit('timeSelectedData', [
                'sched_type' => $inShift->type,
                'reliever' => $inShift->reliever,
            ]);
        }
    }

    public function formulateNewShifts($appointments, &$shifts, $duration = 5)
    {
        $appointments->each(function($appt) use (&$shifts, $duration) {
            $first = Arr::first($shifts, function ($shift, $key) use ($appt) {
                return $appt->actual_datetime >= $shift['from'] && $appt->actual_datetime <= $shift['to'];
            });
            if (!$first) return;

            $index = array_search($first, $shifts);
            if ($appt->actual_datetime == $first['from']) {
                if ($appt->actual_endtime == $first['to']) {
                    unset($shifts[$index]);
                } else {
                    $shifts[$index]['from'] = $appt->actual_endtime;
                }
            } else if ($appt->actual_endtime->subMinutes($duration) == $first['to']) {
                $shifts[$index]['to'] = with($first['to'])->subMinutes($duration);
            } else {
                $shifts[$index]['to'] = $appt->actual_datetime->subMinutes($duration);
                array_push($shifts, [
                    'from' => $appt->actual_endtime,
                    'to' => $first['to'],
                ]);
            }
        });
    }

    public function selectAlpha($alpha)
    {
        $this->alpha = $alpha;
    }

    public function render()
    {
        $query = new Doctor;

        if ($this->search) {
            $query = $query->where(
                DB::raw('concat(first_name, " ", last_name)'), 'like', '%'.$this->search.'%'
            );
        }

        if($this->specializationId) {
            $query = $query->whereHas('specializations', function($q) {
                $q->where('specialization_id', $this->specializationId)->where('name', '!=', 'Covid Home Visit');
            });
        }

        if ($this->hmoId) {
            $query = $query->whereHas('hmos', function($q) {
                $q->where('hmo_id', $this->hmoId);
            });
        }

        if ($this->gender) {
            $query = $query->where('gender', $this->gender);
        }

        if ($this->alpha) {
            $query = $query->where('last_name', 'like', $this->alpha.'%');
        }

        $clinicDays = [
            'Mon' => 1,
            'Tue' => 2,
            'Wed' => 3,
            'Thu' => 4,
            'Fri' => 5,
            'Sat' => 6,
            'Sun' => 7,
        ];
        $hasCheckDays = Arr::first($this->filterClinicDays, function ($value, $key) {
            return $value;
        });
        $checked = array_filter($this->filterClinicDays);
        if (count($checked) > 0) {
            $values = array_map(function($v) use ($clinicDays) {
                return strval($clinicDays[$v]);
            }, array_keys($checked));
            $query = $query->where(function($q) use ($values) {
                $cntr = 0;
                foreach ($values as $value) {
                    if($cntr == 0){
                        $q->where('clinic_days', 'like', '%'.$value.'%');
                    }else{
                        $q->orWhere('clinic_days', 'like', '%'.$value.'%');
                    }
                    $cntr++;
                }
            });
        }

        $doctors = $query->whereDoesntHave('specializations', function($query) {
            $query->where('name', 'Covid Home Visit');
        })->orderBy('last_name')->take($this->limit)->get();
        
        $specializations = Specialization::where('name', '!=', 'Covid Home Visit')->orderBy('name')->get();

        $alphas = range('A', 'Z');
        array_unshift($alphas, '');

        $hmos = HmoAccreditation::orderBy('name')->get();

        return view('livewire.doctor-search', compact(
            'doctors', 'specializations', 'hmos', 'alphas', 'clinicDays'));
    }
}
