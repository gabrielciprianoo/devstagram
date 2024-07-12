<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
});

// Register Routes
Route::controller(RegisterController::class)->group(function () {
    Route::get('/create-account', 'index')->name('register');
    Route::post('/create-account', 'store');
});

// Login Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store');
});

// Logout Route
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Post Routes
Route::controller(PostController::class)->group(function () {
    Route::get('/{user:username}', 'index')->name('posts.index');
    Route::get('/posts/create', 'create')->name('posts.create');
    Route::post('/posts', 'store')->name('posts.store');
    Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
    Route::get('/{user:username}/posts/{post}', 'show')->name('posts.show');
});

// Comments Routes
Route::controller(CommentController::class)->group(function () {
    Route::post('/{user:username}/posts/{post}', 'store')->name('comments.store');
});

// Image Routes
Route::post('/images', [ImageController::class, 'store'])->name('images.store');
