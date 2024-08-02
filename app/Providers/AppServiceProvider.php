<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

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
    public function boot(Request $request): void
    {
//        $this->app->booted(function () use ($request) {
//            // Get the token from the URL parameters
//            $token = $request->route('token');
//            dd($token);
//            // You can now use $token as needed
//            // For example, you might bind it to the container
//            $this->app->instance('apiToken', $token);
//        });

//        dd($request->route('token'), \request()->url());
    }
}
