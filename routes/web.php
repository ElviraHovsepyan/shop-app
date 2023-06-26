<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products');
        Route::get('/products/create', 'create')->name('products.create');
        Route::get('/products/{id}', 'getOne')->name('products.get');
        Route::get('/products/edit/{id}', 'edit')->name('products.edit');
        Route::post('/products', 'store')->name('products.store');
        Route::post('/products/id', 'update')->name('products.update');
        Route::get('/products/delete/{id}', 'destroy')->name('products.delete');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories');
        Route::get('/categories/create', 'create')->name('categories.create');
        Route::get('/categories/{id}', 'getOne')->name('categories.get');
        Route::get('/categories/edit/{id}', 'edit')->name('categories.edit');
        Route::post('/categories', 'store')->name('categories.store');
        Route::post('/categories/update', 'update')->name('categories.update');
        Route::get('/categories/delete/{id}', 'destroy')->name('categories.delete');
    });


});





require __DIR__.'/auth.php';
