<?php

namespace App\Livewire;

use App\Models\Enclosure;
use Livewire\Component;

class ProductsTable extends Component
{

    public $products;
    public array $quantity = [];
    public function mount()
    {
        $this->products = Enclosure::all();
        foreach ($this->products as $product) {
        $this->quantity[$product->id] = 1;
        }
    }

    public function render()
    {
        return view('livewire.products-table');
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
        $this->dispatch('cart_updated');
    }
}
