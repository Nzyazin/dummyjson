<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/products/fetch-iphones', [HomeController::class, 'fetchIPhoneProducts'])->name('products.fetch-iphones');
Route::delete('/products/delete-iphones', [HomeController::class, 'deleteIPhoneProducts'])->name('products.delete-iphones');


