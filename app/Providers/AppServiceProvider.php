<?php

namespace App\Providers;

use App\GraphQL\Resolvers\DefaultFieldResolver;
use App\Models\User;
use GraphQL\Executor\Executor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // enable built-in query logging
        DB::listen(static function ($query) {
            Log::info($query->sql);
            Log::info($query->bindings);
            Log::info($query->time);
        });

        // set our own GraphQL default field resolver
        Executor::setDefaultFieldResolver([DefaultFieldResolver::class, 'defaultFieldResolver']);

        Gate::define('access-admin', static function (User $currentUser) {
            return $currentUser->isAdmin();
        });

        Gate::define('access-admin-or-self', static function (User $currentUser, $id) {
            return $currentUser->isAdmin() || $currentUser->isAdminOrSelf($id);
        });
    }
}
