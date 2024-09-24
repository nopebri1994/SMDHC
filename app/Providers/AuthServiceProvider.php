<?php

namespace App\Providers;

use App\Models\UserModel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (UserModel $user) {
            return $user->role == '1';
        });

        Gate::define('payroll', function (UserModel $user) {
            return $user->role <= '2';
        });

        Gate::define('hc', function (UserModel $user) {
            return $user->role <= '3';
        });

        Gate::define('adminBagian', function (UserModel $user) {
            return $user->role >= '4';
        });

        Gate::define('itAdmin', function (UserModel $user) {
            return $user->role >= '3' or $user->role == '1';
        });
    }
}
