<?php

use App\Http\Controllers\ProductController;
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

// Product routes
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products/fetch-iphones', [ProductController::class, 'fetchAndSaveIPhoneProducts']);
