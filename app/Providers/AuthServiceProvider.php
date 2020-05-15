<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Utils\ReplicadoUtils;

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

        Gate::define('admin', function ($user) {
            $admins = explode(',', trim(getenv('ADMINS')));
            return ( in_array($user->codpes, $admins) and $user->codpes );
        });

        Gate::define('logado', function ($user) {
            return true;
        });
        
        # docentes 
        Gate::define('docente', function ($user) {
            if(ReplicadoUtils::ehdocente($user->codpes)){
                return true;
            }
            $admins = explode(',', trim(getenv('ADMINS')));
            return ( in_array($user->codpes, $admins) and $user->codpes );
        });
    }
}
