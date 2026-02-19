<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Models\Category;
use App\Models\Post;
use App\Services\FilePostRepository;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (config('posts.source') === 'files') {
        $repo = app(FilePostRepository::class);
        $posts = $repo->all(request('category'));
        $categories = $repo->getCategories();
    } else {
        $posts = Post::with('category')->latest()->get();
        if (request('category')) {
            $posts = $posts->where('category_id', request('category'));
        }
        $categories = Category::orderBy('name')->get();
    }
    return view('home', compact('posts', 'categories'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/post/{slugOrId}', [PostController::class, 'show'])->name('post.show');

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
