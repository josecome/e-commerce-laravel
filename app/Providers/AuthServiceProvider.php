<?php

namespace App\Providers;

use App\Models\User;
use App\Models\ProdCategories;
use App\Models\Cart;
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

        Gate::define('isAdmin', function ($user) {
            return $user->role === "admin";
        });

        Gate::define('isManager', function ($user) {
            return $user->role === "manager";
        });

        Gate::define('isSeller', function ($user) {
            return $user->role === "seller";
        });

        Gate::define('isUser', function ($user) {
            return $user->role === "user";
        });

        Gate::define('belongToUser', function ($user, Cart $cart) {
            return $user->id === $cart->user_id;
        });
    }
}
