<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Parcel;
use App\Models\RecipientCredential;
use App\Models\ParcelEnclosure;


class ParcelController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        
        if ($user) {
            $credentialsCheck = $user->credential()->first();
        
            if ($credentialsCheck) {
                $credentials = $credentialsCheck;
                return view('parcel', compact( 'credentials'));
            }
        }
        
        return view('parcel');
    }
    
    public function store(Request $request)
    {
        if ($request->has('registerCheck') && $request->input('registerCheck') == '1') {
            // Call the register method on your authentication controller
            app('App\Http\Controllers\Auth\RegisterController')->register($request);
        }
        
        $orderNum = rand(10000, 99999);

        $deliveryInfo = $request->all();
//        preparing data to send via bot
        dd($deliveryInfo);
        
        $itemCounter = 0;
        foreach ($cartItems as $item) {
            $itemCounter++;
            $cartItemsString = $cartItemsString . $itemCounter . "\r\n";
            $cartItemsString = $cartItemsString . $item['name'] . "\r\n" .
                'Кол-во: ' . $item['quantity'] . "\r\n" .
                'Вес: ' . $item['attributes']['weight'] . "\r\n";
        }
        $deliveryDataString = 'Адрес: ' . $deliveryInfo['address'] . "\r\n" .
            'квартира: ' . $deliveryInfo['apartment'] . "\r\n" .
            'коммент: ' . $deliveryInfo['comment'] . "\r\n" .
            'ФИО: ' . $deliveryInfo['name'] . ' ' . $deliveryInfo['surname'] . ' ' . $deliveryInfo['middle_name'] . "\r\n" .
            'телефон: ' . $deliveryInfo['telephone'] . "\r\n";
        //TELEGRAM NOTIFY!
//        $tg = app()->make('App\Services\TelegramService');
//        $tg->sendMessage('новый заказ!, номер заказа: ' . $orderNum . "\r\n" . "\r\n" .
//            'Товары:' . "\r\n" .
//            $cartItemsString . "\r\n" . "\r\n" .
//            'Инфа для доставки: ' . "\r\n" .
//            $deliveryDataString
//        );

//        store data
        
        foreach ($deliveryInfo as $key => $value) {
            $deliveryInfo[$key] = trim($value);
        }
        
        $credential = RecipientCredential::create([
            'name' => $deliveryInfo['name'],
            'surname' => $deliveryInfo['surname'],
            'middle_name' => $deliveryInfo['middle_name'],
            'address' => $deliveryInfo['address'],
            'apartment' => $deliveryInfo['apartment'],
            'comment' => $deliveryInfo['comment'],
            'tel' => $deliveryInfo['telephone'],
            'whatsapp' => $deliveryInfo['whatsapp'],
            'telegram' => $deliveryInfo['telegram'],
            'email' => $deliveryInfo['email'],
        ]);
        
        $order = Parcel::create([
            'order_num' => $orderNum,
            'credential_id' => $credential->id,
            'total' => $total,
            'subtotal' => $subtotal,
            'delivery' => $deliveryType,
            'delivery_cost' => $deliveryPrice,
            'comment' => $deliveryInfo['comment'],
        ]);
        
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $order->user_id = $user_id;
            $order->save();
            
            $currentUserCredentials = RecipientCredential::where('user_id', $user_id)->first();
            if (!$currentUserCredentials) {
                $credential->user_id = $user_id;
                $credential->save();
            }
        }
        
        foreach ($cartItems as $item) {
            $products = new ParcelEnclosure;
            $products->order_id = $order->id;
            $products->product_id = $item['id'];
            $products->quantity = $item['quantity'];
            $products->save();
        }
        
        \Cart::clear();
        return view('order', compact('cartItems', 'deliveryInfo', 'orderNum', 'subtotal', 'deliveryPrice', 'deliveryType', 'total'));
    }
}

