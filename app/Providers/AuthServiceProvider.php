<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        //edit user gate

        Gate::define('edit-user',function ( $user,  $user_model){
            return $user->hasRole('admin') || $user->id === $user_model->id;
        });

        Gate::define('adminOnly',function ( $user,  $user_model){
            return $user->hasRole('admin');
        });
    }
}
