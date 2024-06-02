<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\VerifyUserRol;
use App\Http\Middleware\VerifyUserStatus;


/* Rutas para la Tienda */

Route::get('/', [ShopController::class, 'index'])->name('raiz');
Route::get('/view/{id}', [ShopController::class, 'view'])->name('shop.view');
// Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

/* Rutas con Autentificacion */
Route::middleware(['auth', VerifyUserStatus::class, VerifyUserRol::class])->group(function () {
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
    Route::get('/products/photos/{id}', [ProductController::class, 'photos'])->name('products.photos');
    Route::post('/products/photos_store/{id}', [ProductController::class, 'photos_store'])->name('products.photos_store');
    Route::resource('products', ProductController::class);

    /* Tienda */
    Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});


require __DIR__ . '/auth.php';
