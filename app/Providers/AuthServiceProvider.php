<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use App\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot()
    {
        $this->registerPolicies();

        foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasPermissionTo($permission);
            });
        }
    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
