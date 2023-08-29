<?php

use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CountryController;
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

Route::middleware('cors')->group( function () {

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group( function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::controller(BasketController::class)->group(function () {
        Route::get('/basket', 'index')->name('basket');
        Route::post('/basket', 'store')->name('basket.store');
        Route::post('/basket/{id}', 'update')->name('basket.update');
        Route::get('/basket/delete/{id}', 'destroy')->name('basket.delete');
        Route::get('/basket/deleteProduct/{id}', 'deleteOneProduct')->name('basket.deleteOne');

    });

});

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products');
        Route::get('/products/all', 'index')->name('products');
        Route::post('/products/all', 'getFiltered')->name('products.filtered');
        Route::get('/products/{id}', 'getOne')->name('products.get');

    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories');

    });

    Route::controller(CountryController::class)->group(function () {
        Route::get('/countries', 'index')->name('countries');

    });



});


