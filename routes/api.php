<?php

use Illuminate\Support\Facades\Route;
use Keky\Product\Http\Controllers\CollectionsController;
use Keky\Product\Http\Controllers\OptionsController;
use Keky\Product\Http\Controllers\OptionsValueController;
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

// create option
Route::post('/options', [OptionsController::class, 'store']);

// create option value
Route::post('/option-values', [OptionsValueController::class, 'store']);

// attach one product to many options
Route::post(
    '/products/{id}/options',
    [ProductsController::class, 'attachOptions']
);

// attach one option to many products
Route::post(
    '/options/{id}/products',
    [OptionsController::class, 'attachProducts']
);
