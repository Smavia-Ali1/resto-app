<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SpecialMealController extends Controller
{
    public function index()
    {
        $special_meals = Category::where('name', 'Specials')->first();
        return view('welcome', compact('special_meals'));
    }
}
