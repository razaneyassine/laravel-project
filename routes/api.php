<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopifyController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);
});

// routes/api.php
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(\App\Http\Middleware\XHeaderAuthentication::class)->group(function () {

    Route::post('/customers',[ShopifyController::class,'signUp']);
    Route::get('/customers', [ShopifyController::class,'getCustomers']);
    Route::get('/shopify', [ShopifyController::class,'index']);
    Route::get('/collections', [ShopifyController::class,'collections']);
    Route::get('/trending', [ShopifyController::class,'trending']);
});
