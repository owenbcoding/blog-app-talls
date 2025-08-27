<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $allCategories = DB::table('categories')->get();
        $allCategories = ['Category 1', 'Category 2'];
        return view('home', ['categories' => $allCategories]); 
    }
}
