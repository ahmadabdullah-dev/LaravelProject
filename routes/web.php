<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Home page - accessible by everyone (shows all products)
Route::get('/', [ProductController::class, 'home'])->name('home');

// Product details page - accessible by everyone
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Dashboard - only accessible by logged-in users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Profile routes - only accessible by logged-in users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart routes - only accessible by logged-in users
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');

    // Order routes - only accessible by logged-in users
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/orders', [OrderController::class, 'history'])->name('orders.history');
});

// Admin routes - only accessible by users with role = "admin"
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Category management
    Route::resource('categories', CategoryController::class);

    // Product management (except show - which is public)
    Route::resource('products', ProductController::class)->except(['show']);
});

require __DIR__.'/auth.php';
