<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Sale\SaleController;

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

Route::middleware('auth:sanctum')->group(function (){

    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/checkToken', [AuthController::class, 'checkToken']);
    Route::post('/auth/register', [AuthController::class, 'register']);

    
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('sales', SaleController::class)
        ->only(['index', 'store', 'show']);
});

// Route::get('/categories', [CategoryController::class, 'index']);
// Route::post('/categories', [CategoryController::class, 'store']);
// Route::get('/categories/{term}', [CategoryController::class, 'show']);
// Route::put('/categories/{id}', [CategoryController::class, 'update']);
// Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

Route::post('/auth/login', [AuthController::class, 'login']);
