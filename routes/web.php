<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/news', [AdminController::class, 'indexnews'])->name('news.index');
});


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('/news', [UserController::class, 'news'])->name('news');
    Route::get('/gallery', [UserController::class, 'gallery'])->name('gallery');
    Route::get('/contact', [UserController::class, 'contact'])->name('contact');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});