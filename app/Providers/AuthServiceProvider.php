<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Role;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Gate;
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
          Gate::define('isAdmin', function(User $user){
        return $user->role->name === 'Admin';
    });
     Gate::define('isManager', function($user){
        return $user->role->name === 'Manager';
    });
     Gate::define('isUser', function($user){
        return $user->role->name === 'User';
    });
     Gate::define('isVisitor', function($user){
        return $user->role->name === 'Visitor';
    });
    }
}
