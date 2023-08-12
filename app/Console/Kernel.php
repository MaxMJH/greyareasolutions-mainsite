<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Models\User;

/**
 * This class allows for the establishment of schedules to be used within the
 * web application.
 *
 * @package App\Console
 *
 * @author Max Harris <MaxHarrisMJH@gmail.com>
 *
 * @version v0.0.1
 *
 * @since v0.0.1
 */
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule Instance of the framework's 'Schedule' class.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Create a schedule that unlocks an account after 30 minutes (check every minute).
        $schedule->call(function() {
            // Get an array of users that are locked.
            $lockedUsers = User::where('is_locked', 1)->get();

            // Iterate through each locked user, and check if the 'lock_till' has elapsed 30 minutes.
            foreach ($lockedUsers as $user) {
                // Get the unlock time.
                $unlockTime = $user->lock_till;

                // Check if the current time is greater than or equal to the user's 'lock_till'.
                if (Carbon::now()->gte($unlockTime)) {
                    // Nullify the 'lock_till', unlock the user's account, and update the table.
                    $user->lock_till = null;
                    $user->is_locked = 0;
                    $user->save();
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
