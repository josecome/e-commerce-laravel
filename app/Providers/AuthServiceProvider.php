<?php

namespace App\Providers;

use App\Models\User;
use App\Models\ProdCategories;
use App\Policies\ProdCategoriesPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        ProdCategories::class => ProdCategoriesPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        function isSuperAdmin(){
           return TRUE; //Will be updated
        }
        Gate::define('addupdate_ctgry', function () {
            //return isSuperAdmin();
            return isSuperAdmin()
            ? Response::allow()
            : Response::deny('You must be an administrator!');
        });

    }
}
