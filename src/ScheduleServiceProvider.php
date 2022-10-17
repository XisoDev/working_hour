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
        $this->registerPublishables();
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


    protected function registerPublishables(): void
    {
        $this->publishes([
            __DIR__.'/../config/working_hours.php' => config_path('working_hours.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/2018_05_19_135648_schedules.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_working_hours.php'),
        ], 'migration');
    }
}
