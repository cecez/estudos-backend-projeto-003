<?php

namespace Cecez\Dolly;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DollyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cache', function ($expression) {
            return "<?php if (! Cecez\Dolly\RussianCaching::setUp($expression)) { ?>";
        });

        Blade::directive('endcache', function () {
            return "<?php } echo Cecez\Dolly\RussianCaching::tearDown(); ?>";
        });
    }
}
