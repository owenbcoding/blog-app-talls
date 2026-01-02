<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::when(request('category'), function ($query) {
            $query->where('category_id', request('category'));
        })->latest('id')->get();
        
        return view('home', compact('categories', 'posts'));
    }
}
