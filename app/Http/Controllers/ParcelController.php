<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParcelCheckout;
use App\Models\Address;
use App\Models\CustomContent;
use App\Models\Enclosure;
use App\Models\SenderCredential;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;
use App\Models\Parcel;
use App\Models\RecipientCredential;
use phpDocumentor\Reflection\Types\Integer;


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
//dd($formData);

//        preparing data to send via bot
        info(print_r($formData, true));

//        store data
        
        $senderCredentials = SenderCredential::create([
//            'user_id' => Auth::id() ?? null,
            'name' => $formData['sender_name'],
            'surname' => $formData['sender_surname'],
            'city' => $formData['sender_city'],
            'address' => $formData['sender_address'],
            'postal_code' => $formData['sender_postal_code'],
            'email' => $formData['email'],
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
            'sender_credentials_id' => $senderCredentials->id,
            'recipient_credentials_id' => $recipientCredentials->id,
            'address_id' => $address->id,
            'delivery_cost' => $formData['calculatedDeliveryCost'],
            'delivery_type' => $formData['deliveryType'],
            'custom_delivery' => isset($formData['customDelivery']) ?? null,
            'track_id' => $this->getUnusedTrackNumber()
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
                'value' => $item['value'],
            ]);
        }
        $track =  Track::find($parcel->track_id)?->number;
        $customText = CustomContent::first()->checkout_thanks;
        $enclosures = $formData['items'];
//        return view('order', compact('cartItems', 'formData', 'orderNum', 'subtotal', 'deliveryPrice', 'deliveryType', 'total'));
        return view('order', compact('orderNum','track', 'customText', 'enclosures' ));
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
    
    private function getUnusedTrackNumber():int|null
    {
        // Используем левое соединение для поиска треков, которые не привязаны к посылкам
        $track = Track::leftJoin('parcels', 'tracks.id', '=', 'parcels.track_id')
            ->whereNull('parcels.track_id')
            ->select('tracks.id')
            ->first();
        // Возвращаем ID трека или null, если таких треков нет
        if($track) {
            $trackId = $track->id;
        } else {
            $trackId = null;
        }
        return $trackId;
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

