<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::middleware('api')->group(function () {
//     Route::get('/products', [ProductController::class, 'index']);
//     // Add other routes as needed
// });

Route::get('/products', [ProductController::class, 'index']);