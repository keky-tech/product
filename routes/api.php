<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * -------------------------------
 *  GESTION CRUD STORAGE SYSTEM
 * -------------------------------
 */
//API endpoint to create product
Route::match(['GET', 'POST'], 'creatProduct', [ProductController::class, 'creatProduct']);
//API endpoint to create option
Route::match(['GET', 'POST'], 'creatOption', [ProductController::class, 'creatOption']);
//API endpoint to create option value
Route::match(['GET', 'POST'], 'creatOption_value', [ProductController::class, 'creatOption_value']);
// API endpoint to attach one product to many options
Route::match(['GET', 'POST'], 'oneproduct_to_options', [ProductController::class, 'oneproduct_to_options']);
//API endpoint to attach one option to many products
Route::match(['GET', 'POST'], 'oneOption_to_products', [ProductController::class, 'oneOption_to_products']);
