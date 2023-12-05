<?php

namespace App\Http\Controllers;



class MockCartController extends Controller
{

    
    
    public function store()
    {

        return view('order_beta', json_decode(cache('cart_mock'), true));
    }
}
