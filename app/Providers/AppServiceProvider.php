<?php

namespace App\Providers;

use App\Contracts\Payments\GatewayInterface;
use App\Contracts\Products\OrderInterface;
use App\Contracts\Products\ProductInterface;
use App\Contracts\UserInterface;
use App\Repositories\Payments\Gateways\Stripe;
use App\Repositories\Products\OrderRepository;
use App\Repositories\Products\ProductRepository;
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

        /** Product binding */
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(ProductInterface::class,ProductRepository::class);
    }
}
