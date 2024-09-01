<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $dis = [

        ];

        foreach ($dis as $di)
        {
            foreach ((new $di)() as $interface => $implementation )
            {
                if (!app()->isProduction())
                {
                    $this->app->bind($interface, $implementation['prod']);
                } else {
                    $this->app->bind($interface, $implementation['mock']);
                }
            }
        }
    }
}
