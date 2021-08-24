<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //
        // $schedule->call(function () {
        //     logger('scheduler called every min');
        // })->everyMinute();

        // $schedule->command('backup:clean')->daily()->at('01:00');
        // $schedule->command('backup:run --only-db')->daily()->at('02:00');

        $schedule->job(new \App\Jobs\RemindBookings)->everyFiveMinutes();

        $schedule->job(new \App\Jobs\RemindAppointments)->everyFiveMinutes();

        // $schedule->job(new \App\Jobs\RedoScreening)->dailyAt('10:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
