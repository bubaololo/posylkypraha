<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MainPageController extends Controller
{
    public function index()
    {
        $buyNowProduct = Product::where('weight', '=', 20)->first();
        
        return view('main-page', compact('buyNowProduct'));


    }
}
