<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::prefix('productos')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/destacados', [ProductController::class, 'featured'])->name('products.featured');
    Route::get('/populares', [ProductController::class, 'popular'])->name('products.popular');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
});

Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->middleware('throttle:5,1');

Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register'])->middleware('throttle:3,10');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/perfil', [UserController::class, 'profile'])->name('profile');

    Route::get('/checkout', [OrderController::class, 'checkoutForm'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/confirmacion/{id}', [OrderController::class, 'confirmation'])->name('checkout.confirmation');

    Route::get('/pedidos', [OrderController::class, 'history'])->name('orders.history');
    Route::get('/pedidos/{id}', [OrderController::class, 'show'])->name('orders.show');

    Route::prefix('admin')->middleware('is_admin')->group(function () {

        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::prefix('categorias')->group(function () {
            Route::get('/', [CategoryController::class, 'admin'])->name('admin.categories');
            Route::get('/crear', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/{id}/editar', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        });

        Route::prefix('productos')->group(function () {
            Route::get('/', [ProductController::class, 'admin'])->name('admin.products');
            Route::get('/crear', [ProductController::class, 'create'])->name('products.create');
            Route::post('/', [ProductController::class, 'store'])->name('products.store');
            Route::get('/{id}/editar', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
            Route::get('/buscar', [ProductController::class, 'search'])->name('products.search');
        });

        Route::prefix('usuarios')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
            Route::get('/crear', [UserController::class, 'create'])->name('admin.users.create');
            Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/{id}/editar', [UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/{id}', [UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        });
    });
});