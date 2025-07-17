<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate agar hanya user non-admin bisa lihat menu user management
        Gate::define('show-users-menu', function ($user) {
            return $user->role !== 'admin';
        });
    }
}
