<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Bus::map([
            // Обратка очередей в приложений.
        ]);
    }
}
