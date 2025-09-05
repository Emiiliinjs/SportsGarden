<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Home route -> show dynamic sports news
Route::get('/', [NewsController::class, 'index'])->name('home');

// Explicit category routes to avoid conflict with auth (/login, /register, etc.)
Route::get('/category/{category}', [NewsController::class, 'category'])->name('category');

// Dashboard route (authenticated users only)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes for profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, password reset)
require __DIR__.'/auth.php';
