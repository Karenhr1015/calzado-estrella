<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StockController;
use App\Models\Product;

/* Rutas para la Tienda */
Route::get('/', [ShopController::class, 'index'])->name('raiz');
Route::get('/view/{id}', [ShopController::class, 'view'])->name('shop.view');
// Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

/* Rutas con Autentificacion */
Route::middleware('auth')->group(function () {
    /* Dashboard */
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    /* Perfil */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    /* Users */
    Route::resource('users', UserController::class);
    /* Colors */
    Route::resource('colors', ColorController::class);
        
    /* Tallas */
    Route::resource('sizes', SizeController::class);
    /* Temporadas */
    Route::resource('seasons', SeasonController::class);
    /* Productos */
    Route::get('/products/dashboard', [ProductController::class, 'dashboard'])->name('products.dashboard');
    Route::resource('products', ProductController::class);
    /* Stocks */
    Route::resource('stocks', StockController::class);
});


require __DIR__.'/auth.php';
