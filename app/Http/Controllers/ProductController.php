<?php

namespace App\Http\Controllers;

use App\Models\Enclosure;

class ProductController extends Controller
{
    public function productList()
    {
        $products = Enclosure::all();

        return view('products', compact('products'));
    }
    public function singleProduct($slug)
    {
        $product = Enclosure::where('slug', $slug)->firstOrFail();
        return view('product', compact('product'));
    }
    
}
