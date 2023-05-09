<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::forContext('filament-users', function () {
                    Filament::registerUserMenuItems([
                        'logout' => UserMenuItem::make()->label('Log Out')->url(route('filament-users.logout')),
                        ]);
                    });
                });
    }
}
