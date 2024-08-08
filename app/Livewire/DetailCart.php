<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;


class DetailCart extends Component
{

    protected $listeners = ['addCartItems', 'cartItems'];

    public $products;

    public function mount($products)
    {
        $this->products = $products;
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

    public  function addToCart($productId)
    {
        (new Productlists())->addToCart($productId);
        $this->dispatch('addCartItems');

    }


    public function render()
    {
        $cart = Session::get('cart');
        if (isset($cart[$this->products->id])) {
            $net_amount = $cart[$this->products->id]['net_amount'];
            $quantity = $cart[$this->products->id]['quantity'];
        } else {
            $net_amount = $this->products->sale_price;
            $quantity = 1;
        }
        return view('livewire.detail-cart', [
            'cart' => $cart,
            'net_amount' => $net_amount,
            'products' => $this->products,
            'quantity' => $quantity,

        ]);
    }
}
