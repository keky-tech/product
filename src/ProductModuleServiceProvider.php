<?php

namespace Keky\Product;

use Illuminate\Support\ServiceProvider;

class ProductModuleServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'product-migrations');
    }
}
