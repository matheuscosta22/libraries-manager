<?php

use App\Http\Controllers\BookAvailableController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreBookController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);
Route::post('/users', [UserController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum'], static function () {
    Route::delete('/logout', [UserController::class, 'logout']);
    Route::apiResource('/books', BookController::class);
    Route::apiResource('/stores', StoreController::class);
    Route::apiResource('/store-books', StoreBookController::class);
    Route::get('/books/available/{store}', BookAvailableController::class);
});
