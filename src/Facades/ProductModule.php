<?php

namespace Keky\Product\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Keky\Product\ProductModule
 */
class ProductModule extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Keky\Product\ProductModule::class;
    }
}
