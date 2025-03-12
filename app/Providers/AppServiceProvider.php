<?php

namespace App\Providers;

use App\GraphQL\Resolvers\DefaultFieldResolver;
use GraphQL\Executor\Executor;
use Illuminate\Support\Facades\DB;
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
    }
}
