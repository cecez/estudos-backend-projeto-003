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
        $this->app->singleton(BladeDirective::class, function () {
            return new BladeDirective(
                new RussianCaching(app('cache.store'))
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cache', function ($expression) {
            return "<?php if (! app('Cecez\Dolly\BladeDirective')->setUp($expression)) { ?>";
        });

        Blade::directive('endcache', function () {
            return "<?php } echo app('Cecez\Dolly\BladeDirective')->tearDown(); ?>";
        });
    }
}
