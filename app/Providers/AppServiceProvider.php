<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Gate::define('admin-access', function (User $user) {
            return $user->role === 'Admin';
        });

        Gate::define('officer1-access', function (User $user) {
            return $user->role === 'Officer 1' ;
        });

        Gate::define('officer2-access', function (User $user) {
            return $user->role === 'Officer 2';
        });

    }
}
