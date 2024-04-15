<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
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
        $isAdmin = config('constants.user_roles.admin'); // 管理者

        $this->registerPolicies();

        Gate::define('admin', function ($user) use ($isAdmin) {
            return $user !== null && $user->is_admin === $isAdmin; // 管理者の場合
        });
    }
}

