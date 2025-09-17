<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RumorController;
use App\Http\Controllers\CommentController; // <- neaizmirsti importēt!
use Illuminate\Support\Facades\Route;

// Home route -> show dynamic sports news, supports search
Route::get('/', [NewsController::class, 'index'])->name('home');

// Category routes (soccer, basketball, tennis)
Route::get('/category/{category}', [NewsController::class, 'category'])->name('category');

// Dashboard route (authenticated users only)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rumors: create, store, delete
    Route::get('/rumors', [RumorController::class, 'index'])->name('rumors.index');
    Route::post('/rumors', [RumorController::class, 'store'])->name('rumors.store');
    Route::delete('/rumors/{rumor}', [RumorController::class, 'destroy'])->name('rumors.destroy');

    // Comments: store, destroy
    Route::post('/rumors/{rumor}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Individual rumor page (public)
Route::get('/rumors/{rumor}', [RumorController::class, 'show'])->name('rumors.show');

// Fallback route for undefined routes
Route::fallback(function () {
    return redirect('/'); // redirect to home page
});

// Auth routes (login, register, password reset)
require __DIR__.'/auth.php';
