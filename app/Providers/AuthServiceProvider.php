<?php

namespace App\Providers;

use App\Models\Admin\AdminMenu;
use App\Models\Admin\AdminUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;
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

//        //注册权限
//        $adminMenuPermissions = AdminMenu::with('roles')->get();
//
//        foreach ($adminMenuPermissions as $adminMenuPermission) {
//
//            Gate::define($adminMenuPermission->route, function(AdminUser $adminUser) use($adminMenuPermission) {
//
//                return $adminUser->hasAdminMenuPermission($adminMenuPermission);
//
//            });
//
//        }

    }

}
