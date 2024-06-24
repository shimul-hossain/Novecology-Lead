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
        Commands\MinutelyUpdate::class,
        Commands\DailyUpdate::class,
        Commands\EmailCron::class,
        Commands\LocationUpdate::class,
        Commands\RecurrenceAutomatise::class,
        Commands\DailyReporting::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('minutely:update')->everyMinute();
        $schedule->command('location:update')->everyFiveMinutes();
        $schedule->command('email:cron')->everyFiveMinutes();
        $schedule->command('daily:update')->daily();
        $schedule->command('recurrence:automatise')->everyMinute();
        $schedule->command('command:daily-reporting')->at('20:00');
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
