<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* Authorization gates. */
        Gate::define('delete-models', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('view-expense-category-component', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('create-expense-category', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('view-user-component', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('create-medical-test-type', function ($user) {
            return $user->role === 'admin';
        });
    }
}
