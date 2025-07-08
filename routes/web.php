<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get('/fetch-product', [ProductController::class, 'fetchProduct']);
Route::post('/add-product', [ProductController::class, 'addProduct']);
Route::get('/get-product/{id}', [ProductController::class, 'getProduct']);
Route::put('/update-product/{id}', [ProductController::class, 'updateProduct']);
Route::delete('/destroy-product/{id}', [ProductController::class, 'destroyProduct']);

Route::get('/dir-check', function () {
    return view('dir-check.tailwindcheck');
});
