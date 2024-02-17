<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Parcel;
use App\Models\RecipientCredential;
use App\Models\ParcelEnclosure;
use App\Models\Enclosure;
use JsValidator;

class ParcelController extends Controller
{
    protected $validationRules = ['user_id' => 'nullable|exists:users,user_id',
        'sender_name' => 'bail|alpha|required|max:50|string',
        'sender_surname' => 'alpha_dash|required|max:50|string',
        'recipient_name' => 'bail|alpha|required|max:50|string',
        'recipient_surname' => 'alpha_dash|required|max:50|string',
//        'email' => 'required|string|email|max:255|unique:users',
//        'password' => 'required|string|min:8|confirmed',
        'middle_name' => 'alpha|required|max:50|string',
//        'address' => 'required',
        'telephone' => 'integer'
    ];
    
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        
        $user = Auth::user();
        
        if ($user) {
            $credentialsCheck = $user->credential()->first();
            
            if ($credentialsCheck) {
                $credentials = $credentialsCheck;
                return view('cart', compact('cartItems', 'credentials'));
            }
        }
//        $validator = JsValidator::make($this->validationRules);
        foreach ($cartItems as $item) {
            $productSlug = Enclosure::find($item->id)->slug;
            $item->slug = $productSlug;
        }
        return view('cart', compact('cartItems',));
    }
    
    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => $request->image,
                'weight' => $request->weight,
            ],
        ]);
        session()->flash('success', 'Товар успешно добавлен в корзину!');
        
        return redirect()->route('cart.list');
    }
    
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity,
                ],
            ]
        );
        
        session()->flash('success', 'Товар успешно обновлён!');
        
        return redirect()->route('cart.list');
    }
    
    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Товар успешно удалён!');
        
        return redirect()->route('cart.list');
    }
    
    public function clearAllCart()
    {
        \Cart::clear();
        
        session()->flash('success', 'Корзина успешно очищена!');
        
        return redirect()->route('cart.list');
    }
    
    
    public function store(Request $request)
    {
        if ($request->has('registerCheck') && $request->input('registerCheck') == '1') {
            // Call the register method on your authentication controller
            app('App\Http\Controllers\Auth\RegisterController')->register($request);
        }
        
        $orderNum = rand(10000, 99999);
        $total = \Cart::getTotal();
        $subtotal = \Cart::getSubTotal();
        $rawDelivery = (string)\Cart::getConditionsByType('shipping');
        preg_match('/\d+/', $rawDelivery, $deliveryPrice);
        $deliveryPrice = $deliveryPrice[0];
        preg_match('/(?<={")[^"]*/', $rawDelivery, $deliveryType);
        $deliveryType = $deliveryType[0];

//        return redirect(route('cart.list'))->with(['success' => 'заказ успешно оформлен, номер вашего заказа: ']);
        $cartItems = \Cart::getContent();
        $deliveryInfo = $request->all();
//        preparing data to send via bot
        
        $cartItemsString = '';
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

