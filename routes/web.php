<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

/* Rutas para la Tienda */
Route::view('/', 'shop.index')->name('raiz');

/* Rutas con Autentificacion */
Route::middleware('auth')->group(function () {
    /* Dashboard */
    Route::view('/dashboard', 'dashboard')->name('dashboard');

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
    Route::resource('products', ProductController::class);
});


require __DIR__.'/auth.php';
