<?php

namespace App\Imports;

use App\Date;
use App\User;
use App\Doctor;
use App\Schedule;
use Carbon\Carbon;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ScheduleImport implements OnEachRow, WithHeadingRow, WithChunkReading
{
    public $schedules = [];

    public function __construct()
    {
        // HeadingRowFormatter::default('none');
    }

    public function onRow(Row $row)
    {
        $this->schedules = [];
        
        $row = $row->toArray();
        // dd($row);
        $idNumber = $row['doctor_id_number'] ?? null;
        $doctor = Doctor::where('id_number', $idNumber)->first();
        if (!$doctor) return;

        echo $doctor->name.PHP_EOL;
        $this->eachDate($row, $doctor);

        // echo count($this->schedules);

        $doctor->schedules()->saveMany($this->schedules);
    }

    public function eachDate($row, $doctor)
    {
        $runningDate = with(new Carbon)->setDate(2020, 06, 01);
        $endDate = with(new Carbon)->setDate(2020, 06, 11);

        do {
            $header = (string) Str::of($runningDate->toDateString())->replace('-', '_');
            $sched = $row[$header] ?? null;
            if (!$sched) {
                $runningDate->addDay();
                continue;    
            }
            $this->eachTime($runningDate, explode(',', $sched));
            $runningDate->addDay();
        } while ($runningDate->lte($endDate));
    }

    public function eachTime(Carbon $date, $times)
    {
        foreach ($times as $time) {
            [$timeFrom, $timeTo] = explode('-', $time);
            $schedule = new Schedule;
            $schedule->date = $date;
            $schedule->time_in = with(new Carbon($timeFrom))->format('H:i:s');
            $schedule->time_out = with(new Carbon($timeTo))->format('H:i:s');
            $this->schedules[] = $schedule;
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
