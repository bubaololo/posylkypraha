<?php

namespace App\Livewire;

use Livewire\Component;
use Darryldecode\Cart\CartCondition;


class DeliverySelector extends Component
{
    public $deliveryType;
    private $shipping;
    protected $listeners = ['delivery_price_set' => 'render'];
    
    public function render()
    {
        
        \Cart::clearCartConditions();
        //check if we got real delivery price from api
        // to show prices on delivery select screen
        if (session('cdek')) {
            if (session('cdek') == 'fail') {
                $cdekCalculatedDeliveryCost = 'fail';
            } else {
                $cdekCalculatedDeliveryCost = session('cdek');
            }
        } else {
            $cdekCalculatedDeliveryCost = null;
        }
        
        if (session('post')) {
            if (session('post') == 'fail') {
                $postCalculatedDeliveryCost = 'fail';
            } else {
                $postCalculatedDeliveryCost = session('post');
            }
        } else {
            $postCalculatedDeliveryCost = null;
        }
        
        if ($this->deliveryType) {
            //also check if variables set
            // if not we set default prices
            if (session('cdek') && session('cdek') !== 'fail') {
                $cdekDeliveryCost = session('cdek');
            } else {
                $cdekDeliveryCost = 800;
            }
            if (session('post') && session('post') !== 'fail') {
                $postDeliveryCost = session('post');
            } else {
                $postDeliveryCost = 350;
            }

            match ($this->deliveryType) {
                'post' => $this->shipping = new CartCondition([
                    'name' => 'Post',
                    'type' => 'shipping',
                    'target' => 'total',
                    'value' => "+$postDeliveryCost",
                    'attributes' => array()
                ]),
                'sdek' => $this->shipping = new CartCondition([
                    'name' => 'Sdek',
                    'type' => 'shipping',
                    'target' => 'total',
                    'value' => "+$cdekDeliveryCost",
                    'attributes' => array()
                ]),
                
            };
            
            \Cart::condition($this->shipping);
        }
        
        
        $this->dispatch('shipping_set');
        return view('livewire.delivery-selector', compact('cdekCalculatedDeliveryCost', 'postCalculatedDeliveryCost'));
        
    }




//    public function mount(): void
//    {
//        if (session()->has('costs')) {
//            foreach (session('costs') as $cost) {
//                $this->receiveAlert($cost['type'], $cost['message']);
//            }
//            session()->forget('alerts');
//            $this->render();
//        }
//    }
    
    
}
