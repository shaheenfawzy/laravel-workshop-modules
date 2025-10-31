<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $providerFiles = glob('modules/**/src/Providers/*ServiceProvider.php');

        foreach ($providerFiles as $providerFile) {
            $provider = str($providerFile)
                ->after('modules/')
                ->remove('src/')
                ->before('.php')
                ->replace('/', '\\')
                ->prepend('Modules\\')
                ->value();

            $this->app->register($provider);
        }
    }

    public function boot(): void
    {
        //
    }
}
