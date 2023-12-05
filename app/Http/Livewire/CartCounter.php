<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['cart_updated' => 'render', 'quantity_updated' => 'render'];
    public function render()
    {

        $cart_count = \Cart::getTotalQuantity();
        return view('livewire.cart-counter', compact('cart_count'));
    }
}
