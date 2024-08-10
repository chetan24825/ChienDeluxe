<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductModel extends Component
{
    use WithPagination;
    protected $listeners = ['addCartItems', 'cartItems'];


    public $query = '';
    public $product;
    public $attri = 1;

    public function mount($product = null)
    {
        $this->product = $product;
    }

    public function search()
    {
        $this->resetPage();
    }

    public function addToCart($id)
    {
        (new Productlists())->addToCart($id);
        $this->dispatch('addCartItems');
    }
    public function setProducts($attribute_id = 1)
    {
        $this->attri = $attribute_id;
        $attribute_ids = explode(',', $attribute_id);
        return Product::with('category')
            ->where(function ($query) use ($attribute_ids) {
                foreach ($attribute_ids as $id) {
                    $query->orWhere('attribute_id', 'like', '%"' . $id . '"%');
                }
            })
            ->where('status', 1)
            ->orderBy('stock', 'DESC')
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    }

    public function render()
    {
        if ($this->product) {
            $products =  Product::with('category')
                ->where('status', 1)
                ->where('product_name', 'like', '%' . $this->product . '%')
                ->orderBy('stock', 'DESC')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $attribute_ids = explode(',', $this->attri);

            $products =  Product::with('category')
                ->where(function ($query) use ($attribute_ids) {
                    foreach ($attribute_ids as $id) {
                        $query->orWhere('attribute_id', 'like', '%"' . $id . '"%');
                    }
                })
                ->where('status', 1)
                ->orderBy('stock', 'DESC')
                ->orderBy('id', 'DESC')
                ->get();
        }

        return view('livewire.product-model', [
            'products' => $products,
        ]);
    }
}
