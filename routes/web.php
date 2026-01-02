<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

// Route::view('/', 'home')->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::view('about', 'about')->name('about');
Route::view('contact', 'contact')->name('contact');
Route::view('article', 'article')->name('article');