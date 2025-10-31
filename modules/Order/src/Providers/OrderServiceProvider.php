<?php

namespace Modules\Order\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class OrderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrations();
        $this->loadRoutes();
    }

    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
    }

    protected function loadroutes(): void
    {
        if (file_exists($routes = __DIR__."/../../routes/api.php")) {
            Route::middleware('api')
                ->as('api.')
                ->group($routes);
        }
    }
}