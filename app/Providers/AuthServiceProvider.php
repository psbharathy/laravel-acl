<?php

namespace App\Providers;

use App\Models\Permission;
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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        // $gate->before(function ($user) {
        //     if ($user->isSuperAdmin()) {
        //         return true;
        //     }
        // });

        // foreach ($this->getPermissions() as $permissions) {
        //    $gate->define($permissions->AccessLevel,
        //         function($user) use ($permissions) {
        //             return $user->hasRole($permissions->roles);
        //         }
        //    );
        // }

    }

    /**
    *  Get Permissions for assigned Roles
    */
    protected function getPermissions() {

        $result = Permission::with('roles')->get();
        return $result;
    }
}
