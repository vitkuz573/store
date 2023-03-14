<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminUserController;
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

// Защищенные маршруты для аутентифицированных пользователей
Route::middleware(['auth'])->group(function () {
    Route::match(['get', 'delete'], '/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/cart/place-order', [CartController::class, 'placeOrder'])->name('checkout.place-order');
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
});

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::resource('orders', AdminOrderController::class)->except(['create', 'store']);
    Route::resource('products', AdminProductController::class)->except(['show']);
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
});

// Публичные маршруты
Route::resource('products', ProductController::class)->only(['index', 'show']);

// Стандартные маршруты аутентификации
Auth::routes();
