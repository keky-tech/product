<?php

namespace Keky\Product;

use Keky\Product\Commands\ProductModuleCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ProductModuleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         */
        $package
            ->name('product-module')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoutes(['web', 'api'])
            ->hasMigrations([
                '2023_12_03_000001_create_products_table',
                '2023_12_05_000002_create_collections_table',
            ])
            ->runsMigrations()
            ->hasCommand(ProductModuleCommand::class);
    }
}
