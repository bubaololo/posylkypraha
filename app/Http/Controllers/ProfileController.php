<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataToView = [];
        $user = Auth::user();
        $credentialsCheck = $user->credential()->first();
        if($credentialsCheck) {
            $credentials = $credentialsCheck;
            $dataToView['credentials'] = $credentials;
        }
        $ordersCheck = $user->order()->get();
        
        if($ordersCheck) {
            $dataToView['orders'] = $ordersCheck;
        }
        return view('profile', $dataToView);
    }
    
    public function order($id) {
        $user = Auth::user();
        $order = $user->order()->find($id);

        $products = $order->product()->get();
        $credentials = $order->credential()->get()[0];
//        dd($credentials);
        return view('profile-order', compact('order', 'products', 'credentials'));
    }
}
