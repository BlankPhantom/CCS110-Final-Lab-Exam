<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [NewsController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::delete('/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
Route::patch('/update/{id}', [NewsController::class, 'update'])->name('news.update');
Route::post('/store-news', [NewsController::class, 'store_news'])->name('store-news');

require __DIR__.'/auth.php';
