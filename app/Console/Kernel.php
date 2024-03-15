<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use function PHPUnit\Framework\directoryExists;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $commands_path[] = __DIR__.'/Commands';
        $modules = config("modules.modules");
        if($modules) {
            foreach ($modules as $module) {
                if (directoryExists(app_path() . '/Modules/' . $module . '/Commands')) {
                   $commands_path[] = app_path() . '/Modules/' . $module . '/Commands';
                }
            }
        }
        $this->load($commands_path);

        require base_path('routes/console.php');
    }
}
