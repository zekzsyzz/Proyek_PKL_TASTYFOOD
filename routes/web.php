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
    Route::get('/news/create', [AdminController::class, 'createnews'])->name('news.create');
    Route::post('/news', [AdminController::class, 'storenews'])->name('news.store');
    Route::get('/news/{id}/edit', [AdminController::class, 'editnews'])->name('news.edit');
    Route::put('/news/{id}', [AdminController::class, 'updatenews'])->name('news.update');
    Route::delete('/news/{id}', [AdminController::class, 'deletenews'])->name('news.destroy');

    Route::get('/gallery', [AdminController::class, 'indexgallery'])->name('gallery.index');
    Route::get('/gallery/create', [AdminController::class, 'creategallery'])->name('gallery.create');
    Route::post('/gallery', [AdminController::class, 'storegallery'])->name('gallery.store');
    Route::delete('/gallery/{id}', [AdminController::class, 'deletegallery'])->name('gallery.destroy');

    Route::get('/contacts', [AdminController::class, 'indexcontact'])->name('contacts.index');
    Route::get('/contacts/{id}', [AdminController::class, 'showcontact'])->name('contacts.show');
    Route::delete('/contacts/{id}', [AdminController::class, 'deletecontact'])->name('contacts.destroy');


});

    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('/about', [UserController::class, 'about'])->name('about');
    Route::get('/news', [UserController::class, 'news'])->name('news');
    Route::get('/gallery', [UserController::class, 'gallery'])->name('gallery');
    Route::get('/contact', [UserController::class, 'contact'])->name('contact');
    Route::post('/contact', [UserController::class, 'storecontact'])->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});