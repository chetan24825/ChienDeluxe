<?php

namespace App\Livewire;

use Livewire\Component;

class Footercarts extends Component
{
    protected $listeners = ['addCartItems','cartItems'];

    public function decrementQty($productId)
    {
        (new Carts())->decrementQty($productId);
        // $this->dispatch('show-flash', ['message' => 'Cart  Update Successfully']);
        $this->dispatch('addCartItems');

    }

    public function incrementQty($productId)
    {
        (new Carts())->incrementQty($productId);
        // $this->dispatch('show-flash', ['message' => 'Cart  Update Successfully']);
        $this->dispatch('addCartItems');

    }
    
    public function tocarddelete($productId)
    {

        (new Carts())->tocarddelete($productId);
        // $this->dispatch('show-flash', ['message' => 'Remove Successfully']);
        $this->dispatch('addCartItems');

    }

    public function render()
    {
        $this->cartItems();
        return view('livewire.footercarts');
    }

    public function cartItems(){
    }
}
