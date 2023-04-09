<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('crud-users', function (User $user) {
            if ($user->role === 'admin') {
                return true;
            }
        });

        Gate::define('retrieve-all-blogs', function (User $user) {
            if ($user->role === 'admin' || $user->role === 'manager') {
                return true;
            }
        });

        Gate::define('rud-blogs', function (User $user, Blog $blog) {
            if ($user->role === 'admin' || $user->role === 'manager') {
                return true;
            } else {
                return $user->id === $blog->id_user;
            }
        });
    }
}
