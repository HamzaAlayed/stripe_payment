<?php

namespace App\Providers;

use App\Contracts\Payments\GatewayInterface;
use App\Contracts\UserInterface;
use App\Repositories\Payments\Gateways\Stripe;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GatewayInterface::class, function () {
            return new Stripe(env('STRIPE_SECRET'));
        });

        /** User binding */
        $this->app->bind(UserInterface::class,UserRepository::class);
    }
}
