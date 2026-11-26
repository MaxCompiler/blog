<?php

use App\Http\Controllers\AuthController;
USE App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class , 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',[AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class , 'logout'])->middleware('auth')->name('logout');

Route::get('/posts', [PostController::class , 'index'])->name('posts.index');

Route::middleware('auth')->group(function(){
    Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{id}',[PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class , 'destroy'])->name('posts.destroy');
});

Route::get('/posts/{id}',[PostController::class, 'show'])->name('posts.show');