<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        Paginator::useBootstrap();

        Gate::define('admin', function (User $user) {
            return $user->role === 'Admin';
        });

        Gate::define('user', function (User $user) {
            return $user->role === 'User' || $user->role === 'Admin';
        });

        Gate::define('hrd', function (User $user) {
            return $user->role === 'HRD' || $user->role === 'Admin';
        });
    }
}
