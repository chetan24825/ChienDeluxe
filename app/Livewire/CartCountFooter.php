<?php

namespace App\Livewire;

use Livewire\Component;

class CartCountFooter extends Component
{

    protected $listeners = ['addCartItems', 'render'];

    public function render()
    {
        return view('livewire.cart-count-footer', [
            'carts' => count(session('cart')??[]),
            
        ]);
    }

}
