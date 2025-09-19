<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RumorController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [NewsController::class, 'index'])->name('home');

// Category routes
Route::get('/category/{category}', [NewsController::class, 'category'])->name('category');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// News show
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rumors (CRUD)
    Route::get('/rumors', [RumorController::class, 'index'])->name('rumors.index');
    Route::post('/rumors', [RumorController::class, 'store'])->name('rumors.store');
    Route::get('/rumors/{rumor}/edit', [RumorController::class, 'edit'])->name('rumors.edit');
    Route::put('/rumors/{rumor}', [RumorController::class, 'update'])->name('rumors.update');
    Route::delete('/rumors/{rumor}', [RumorController::class, 'destroy'])->name('rumors.destroy');

    // Comments
    Route::post('/rumors/{rumor}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Public rumor page
Route::get('/rumors/{rumor}', [RumorController::class, 'show'])->name('rumors.show');

// Fallback
Route::fallback(function () {
    return redirect('/');
});

// Auth routes
require __DIR__.'/auth.php';
