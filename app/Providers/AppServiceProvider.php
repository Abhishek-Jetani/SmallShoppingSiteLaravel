<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Models\Order;
use App\Observers\OrderObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository Pattern - Binding Interface to Implementation
        // This allows dependency injection of ProductRepositoryInterface
        // and Laravel will automatically inject ProductRepository
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Observer Pattern - Register OrderObserver to listen to Order model events
        // This observer will automatically be triggered when Order events occur
        Order::observe(OrderObserver::class);
    }
}
