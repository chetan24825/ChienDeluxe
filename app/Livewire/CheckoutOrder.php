<?php

namespace App\Livewire;

use Livewire\Component;

class CheckoutOrder extends Component
{
    protected $listeners = ['addCartItems', 'cartItems'];

    public $courier = true;
    public $pickup = false;

    public function toggleCourier()
    {
        $this->courier = true;
        $this->pickup = false;
    }

    public function togglePickup()
    {
        $this->pickup = true;
        $this->courier = false;
    }

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


    public function render()
    {
        $carts = session()->get('cart');
        return view('livewire.checkout-order', [
            'carts' => $carts,
        ]);
    }
}
