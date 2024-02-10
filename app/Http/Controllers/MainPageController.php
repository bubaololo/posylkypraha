<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enclosure;

class MainPageController extends Controller
{
    public function index()
    {
        $buyNowProduct = Enclosure::where('weight', '=', 20)->first();
        
        return view('main-page', compact('buyNowProduct'));


    }
}
