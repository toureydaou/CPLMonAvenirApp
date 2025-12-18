<?php

namespace App\Console;

use App\Console\Commands\NouvelleAnneeScolaire;
use App\Console\Commands\PassageEleves;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(NouvelleAnneeScolaire::class)->everyFiveMinutes()->when(function () {
                 return now()->month == 8;
             })->sendOutputTo(__DIR__ . '/nouvelleAnneeSchedul.log')->withoutOverlapping();
             
        $schedule->command(PassageEleves::class)->everyTenMinutes()->when(function () {
                 return now()->month == 8;
             })->sendOutputTo(__DIR__ . '/passageElevesSchedule.log')->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
