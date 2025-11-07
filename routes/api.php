<?php

use Illuminate\Support\Facades\Route;
use Keky\Product\Http\Controllers\CollectionsController;
use Keky\Product\Http\Controllers\ProductsController;

Route::apiResource('/products', ProductsController::class);

// Attach a product to collections
Route::post(
    '/products/{id}/collections/',
    [ProductsController::class, 'attachCollections']
);

// Create new collection
Route::post('/collections', [CollectionsController::class, 'store']);

// Attach a collection to products
Route::post(
    '/collections/{id}/products',
    [CollectionsController::class, 'attachProducts']
);
