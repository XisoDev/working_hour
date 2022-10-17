<?php

namespace XisoDev\WorkingHours;

use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/working_hours.php' => config_path('working_hours.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/2018_05_19_135648_schedules.php' => database_path('migrations/2018_05_19_135648_schedules.php'),
        ], 'migration');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
