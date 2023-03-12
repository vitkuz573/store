<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', fn () => redirect()->route('products.index'));

// Protected cart routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
    Route::post('/cart/update', [CartController::class, 'updateCartItemQuantity'])->name('cart.updateCartItemQuantity');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
});

// Public routes for products and categories
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::get('/categories', [CategoryController::class, 'index']);

// Default authentication routes
Auth::routes();

// Named home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
