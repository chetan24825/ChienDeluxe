<?php

namespace App\Livewire;

use Livewire\Component;

class CheckoutOrder extends Component
{
    protected $listeners = ['addCartItems', 'cartItems'];



    public function decrementQty($productId)
    {
        (new Carts())->decrementQty($productId);
        $this->dispatch('addCartItems');
    }

    public function incrementQty($productId)
    {
        (new Carts())->incrementQty($productId);
        $this->dispatch('addCartItems');
    }

    public function tocarddelete($productId)
    {

        (new Carts())->tocarddelete($productId);
        $this->dispatch('addCartItems');
    }

    function removePromoCode()
    {
        session()->forget('promoCodes');
        $this->dispatch('addCartItems');
    }


    public function render()
    {
        $carts = session()->get('cart');
        $promoCodeSession = session()->get('promoCodes');
        return view('livewire.checkout-order', [
            'carts' => $carts,
            'promoCodeSession' => $promoCodeSession
        ]);
    }
}
