<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class DealProduct extends Component
{
    public function addToCart($id)
    {
        (new Productlists())->addToCart($id);
        $this->dispatch('addCartItems');
    }
    public function render()
    {
        $product = Product::where('status', 1)->where('stock', '>', 0)->where('product_deal', 1)->first();
        return view('livewire.deal-product', [
            'product' => $product,
        ]);
    }
}
