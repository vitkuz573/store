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
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::resource('cart', CartController::class)->only(['index', 'update', 'destroy'])->parameters(['cart' => 'productId']);
    Route::resource('orders', OrderController::class)->except(['edit', 'update', 'destroy']);
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
