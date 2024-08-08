<?php

namespace App\Livewire;

use Livewire\Component;

class CartCountheader extends Component
{
    protected $listeners = ['addCartItems', 'render'];
    public function render()
    {
        return view('livewire.cart-count-header', [
            'carts' => count(session('cart') ?? []),
        ]);
    }
}
