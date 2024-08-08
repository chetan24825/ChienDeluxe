<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class ComponentRelatedProducts extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['addCartItems', 'cartItems'];

    public $slug;
    public $attri;
    public $products;

    public function mount($slug)
    {
        $this->slug = Category::where('slug', $slug)->first();
        $this->setProducts();
    }

    public function setProducts($attribute_id = 1)
    {
        $this->attri = $attribute_id;
        $attribute_ids = explode(',', $this->attri);
        $this->products =   Product::with('category')
            ->where(function ($query) use ($attribute_ids) {
                foreach ($attribute_ids as $id) {
                    $query->orWhere('attribute_id', 'like', '%"' . $id . '"%');
                }
            })
            ->where('status', 1)
            ->orderBy('stock', 'DESC')
            ->orderBy('id', 'DESC')
            ->take(4)
            ->get();
    }

    public function addToCart($id)
    {
        (new Productlists())->addToCart($id);
        $this->dispatch('addCartItems');
    }

    public function render()
    {
        return view('livewire.component-related-products');
    }
}
