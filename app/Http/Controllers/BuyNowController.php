<?php

namespace App\Http\Controllers;

use App\Models\Product;

class BuyNowController extends Controller
{
    public function buySpecificProduct($id)
    {
        $product = Product::where('id', '=', $id)->first();
        
        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image,
                'weight' => $product->weight,
            ],
        ]);
        session()->flash('success', 'Товар успешно добавлен в корзину!');
        
        return redirect()->route('cart.list');
    }
}
