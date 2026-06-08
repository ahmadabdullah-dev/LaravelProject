<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home page - accessible by everyone
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard - only accessible by logged-in users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Profile routes - only accessible by logged-in users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes - only accessible by users with role = "admin"
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

require __DIR__.'/auth.php';
