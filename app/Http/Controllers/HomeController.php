<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $allCategories = DB::table('categories')->get();
        return view('home', ['categories' => $allCategories]); 
    }
}
