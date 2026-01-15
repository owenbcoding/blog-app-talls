<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = \App\Models\Post::latest()->get();
    $categories = \App\Models\Category::all();
    return view('home', compact('posts', 'categories'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/post/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('post.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::middleware('is_admin')->group(function () {
        Route::resource('categories', CategoryController::class)->middleware('is_admin');
        Route::resource('posts', PostController::class)->middleware('is_admin');
    });
    

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');
});

require __DIR__.'/auth.php';
