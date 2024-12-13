<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Default route to show the unauthorized dashboard
Route::get('/', [NewsController::class, 'dashboardunauthorized'])->name('dashboardunauthorized');

// Route to login page
Route::get('/login', function () {
    return view('login');
})->name('login');

// Authorized dashboard route
Route::get('/dashboard', [NewsController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard');

// Search news route
Route::get('/search-news', [NewsController::class, 'search'])->name('news.search');

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // News management routes
    Route::post('/store-news', [NewsController::class, 'store_news'])->name('store-news');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::patch('/news/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
});

require __DIR__.'/auth.php';
