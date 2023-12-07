<?php

use Illuminate\Support\Facades\Route;
use Keky\Product\Http\Controllers\CollectionsController;
use Keky\Product\Http\Controllers\ProductsController;

Route::post('/products', [ProductsController::class, 'store']);
Route::put('/products/{id}', [ProductsController::class, 'update']);
Route::delete('/products/{id}', [ProductsController::class, 'destroy']);

//Attach a product to collections
Route::post(
    '/products/{id}/collections/',
    [ProductsController::class, 'attachCollections']
);

// Create new collection
Route::post('/collections', [CollectionsController::class, 'store']);

//Attach a collection to products
Route::post(
    '/collections/{id}/products',
    [CollectionsController::class, 'attachProducts']
);
