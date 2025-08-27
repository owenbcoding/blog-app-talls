<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::view('/', 'home')->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('about', 'about')->name('about');
Route::view('contact', 'contact')->name('contact');
Route::view('article', 'article')->name('article');