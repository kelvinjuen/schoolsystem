<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
    public function boot(GateContract $gate)
    {


        $gate->define('isAdmin', function($user){
            return $user->user_type === 'admin';
        });

        $gate->define('isTeacher', function($user){
            return $user->user_type === 'teacher';
        });

        $gate->define('isFinance', function($user){
            return $user->user_type === 'finance';
        });

        $gate->define('isOffice', function($user){
            return $user->user_type === 'office';
        });
        $this->registerPolicies($gate);

        //
    }
}
