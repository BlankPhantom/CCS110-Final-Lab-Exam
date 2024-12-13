<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;

// Public route for login
Route::get('/', function () {
    return view('login'); // Your login view
});

// Protected route for the dashboard
Route::get('/dashboard', [BlogController::class, 'create'])->name('create-post')->middleware('auth');

// Auth routes for login/logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes for creating and storing blog posts
Route::post('store-blogpost', [BlogController::class, 'store_blogpost'])->name('store-blogpost');
