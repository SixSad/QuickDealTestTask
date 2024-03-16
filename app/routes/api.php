<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/', function () {
    return response()->json(['status' => 'ok']);
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('me', [UserController::class, 'me']);

    Route::prefix('balance')->group(function () {
        Route::get('/', [BalanceController::class, 'index']);
        Route::post('add-balance', [BalanceController::class, 'addBalance']);
    });

    //Можно использовать restFull маршруты
    //условно Route::post('/carts/{cartId}/products/{product_id}', [CartProductController::class, 'store']) с передачей id продукта
    Route::prefix('carts')->group(function () {
        Route::apiResource('/', CartController::class)->only(['index']);
        Route::post('/add-to-cart', [CartProductController::class, 'store']);
        Route::post('/remove-from-cart', [CartProductController::class, 'destroy']);
    });


    Route::apiResource('products', ProductController::class)->only(['index', 'show']);
    Route::apiResource('orders', OrderController::class)->only(['index', 'store', 'destroy']);

});

Route::post('login', [UserController::class, 'login']);

