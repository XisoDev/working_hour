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
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
        $this->mergeConfigFrom(__DIR__ . "/../config/working_hours.php",'working_hours');
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
            __DIR__.'/../database/migrations/2022_10_17_135648_working_hours.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_working_hours.php'),
        ], 'migration');
    }
}
