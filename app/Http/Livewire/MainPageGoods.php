<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class MainPageGoods extends Component
{

    public $products;
    public array $quantity = [];
    public function mount()
    {
        $this->products = Product::all();
        foreach ($this->products as $product) {
            $this->quantity[$product->id] = 1;
        }
    }

    public function render()
    {
        return view('livewire.main-page-goods');
    }

    public function addToCart($product)
    {
        \Cart::add([
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
            'attributes' => [
                'image' => $product['image'],
                'weight' => $product['weight'],
            ],
        ]);
        $this->emit('cart_updated');
    }
}
