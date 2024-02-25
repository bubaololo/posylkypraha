<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParcelCheckout;
use App\Models\Address;
use App\Models\Enclosure;
use App\Models\SenderCredential;
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
                return view('parcel', compact('credentials'));
            }
        }
        
        return view('parcel');
    }
    
    public function store(ParcelCheckout $request)
    {
        if ($request->has('registerCheck') && $request->input('registerCheck') == '1') {
            // Call the register method on your authentication controller
            app('App\Http\Controllers\Auth\RegisterController')->register($request);
        }
        
        $orderNum = rand(10000, 99999);
        
        $formData = $request->all();
        
        $this->trimValuesRecursively($formData);


//        preparing data to send via bot
        info(print_r($formData, true));

//        store data
        
        $senderCredentials = SenderCredential::create([
//            'user_id' => Auth::id() ?? null,
            'name' => $formData['sender_name'],
            'surname' => $formData['sender_surname'],
        ]);
        $recipientCredentials = RecipientCredential::create([
//            'user_id' => Auth::id() ?? null,
            'name' => $formData['recipient_name'],
            'surname' => $formData['recipient_surname'],
            'tel' => $formData['telephone'],
//            'whatsapp' => $formData['whatsapp'],
//            'telegram' => $formData['telegram'],
//            'email' => $formData['email'],
        ]);
        $address = Address::create([
//            'user_id' => Auth::id() ?? null,
            'full_address' => $formData['address'],
            'comment' => $formData['comment'],
            'postal_code' => $formData['postal_code'],
            'admin_area' => $formData['admin_area'],
            'region' => $formData['region'],
            'city' => $formData['city'],
            'street' => $formData['street'],
            'house' => $formData['house'],
            'building' => $formData['premise'],
            'apartment' => $formData['apartment']
        ]);
        
        
        $parcel = Parcel::create([
//            'user_id' => Auth::id() ?? null,
            'order_num' => $orderNum,
            'sender_credential_id' => $senderCredentials->id,
            'recipient_credential_id' => $recipientCredentials->id,
            'address_id' => $address->id,
            'comment' => $formData['comment'],
        ]);
        
//        if (Auth::check()) {
//            $currentUserCredentials = RecipientCredential::where('user_id', $user_id)->first();
//            if (!$currentUserCredentials) {
//                $credential->user_id = $user_id;
//                $credential->save();
//            }
//        }
$parcelId = $parcel->id;
        foreach ($formData['items'] as $item) {
             Enclosure::create([
                'parcel_id' => $parcelId,
                'description' => $item['description'],
                'weight_g' => $item['weight_g'] ?? 0,
                'weight_kg' => $item['weight_kg'],
                'quantity' => $item['quantity'],
            ]);
        }
        
        
//        return view('order', compact('cartItems', 'formData', 'orderNum', 'subtotal', 'deliveryPrice', 'deliveryType', 'total'));
        return view('order',compact('orderNum'));
    }
    
    private function trimValuesRecursively(&$array)
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                $this->trimValuesRecursively($value);
            } else if (is_string($value)) {
                $value = trim($value);
            }
        }
        unset($value);
    }
}

//        $itemCounter = 0;
//        foreach ($cartItems as $item) {
//            $itemCounter++;
//            $cartItemsString = $cartItemsString . $itemCounter . "\r\n";
//            $cartItemsString = $cartItemsString . $item['name'] . "\r\n" .
//                'Кол-во: ' . $item['quantity'] . "\r\n" .
//                'Вес: ' . $item['attributes']['weight'] . "\r\n";
//        }
//        $deliveryDataString = 'Адрес: ' . $formData['address'] . "\r\n" .
//            'квартира: ' . $formData['apartment'] . "\r\n" .
//            'коммент: ' . $formData['comment'] . "\r\n" .
//            'ФИО: ' . $formData['name'] . ' ' . $formData['surname'] . ' ' . $formData['middle_name'] . "\r\n" .
//            'телефон: ' . $formData['telephone'] . "\r\n";
//TELEGRAM NOTIFY!
//        $tg = app()->make('App\Services\TelegramService');
//        $tg->sendMessage('новый заказ!, номер заказа: ' . $orderNum . "\r\n" . "\r\n" .
//            'Товары:' . "\r\n" .
//            $cartItemsString . "\r\n" . "\r\n" .
//            'Инфа для доставки: ' . "\r\n" .
//            $deliveryDataString
//        );

