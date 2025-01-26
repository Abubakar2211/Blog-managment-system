<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.check');

Route::middleware(['auth:sanctum', 'check'])->group(function () {
    Route::view('/dashboard', 'admin.index')->name('dashboard');
    Route::resource('author', AuthorController::class);
    Route::resource('post', PostController::class);
    Route::get('logout',[UserController::class,'logout'])->name('logout');
    Route::view('/blank', 'admin.blank')->name('blank');
    Route::view('/users', 'admin.users')->name('users');
    Route::view('/form', 'admin.form')->name('form');
    Route::view('/update', 'admin.update')->name('update');
});
