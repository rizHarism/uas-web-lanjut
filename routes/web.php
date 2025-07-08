<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get('/product/fetch', [ProductController::class, 'fetchProduct']);
Route::post('/product/store', [ProductController::class, 'store']);
Route::get('/product/{id}/show', [ProductController::class, 'show']);
Route::put('/product/{id}/update', [ProductController::class, 'update']);
Route::delete('/product/{id}/delete', [ProductController::class, 'destroy']);

Route::get('/dir-check', function () {
    return view('dir-check.tailwindcheck');
});
