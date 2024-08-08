<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\UserCart;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Productlists extends Component
{
    protected $listeners = ['addCartItems', 'cartItems'];

    public $products;
    public $carts;
    public $cartCount = 10;
    public $attri;
    public function mount()
    {
        $this->setProducts();
    }

    // public function setProducts($attribute_id = 1)
    // {
    //     $this->attri = $attribute_id;
    //     $this->products = Product::with('category')
    //         ->where('attribute_id', $attribute_id)
    //         ->where('status', 1)
    //         ->orderBy("stock", "DESC")
    //         ->orderBy("id", "DESC")
    //         ->take(12)->get();
    // }

    public function setProducts($attribute_id = '1')
    {
        $this->attri = $attribute_id;
        $attribute_ids = explode(',', $attribute_id);
        $this->products = Product::with('category')
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


    public function addToCart($id)
    {
        $cart = Session::get('cart', []);
        $product = Product::findOrFail($id);
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] < $product->stock) {
                $cart[$id]['quantity']++;
                $cart[$id]['net_amount'] = $product->sale_price * $cart[$id]['quantity'];
                if (auth()->check()) {
                    $userCart = UserCart::where('user_id', auth()->user()->id)->where('product_id', $id)->first();
                    if ($userCart) {
                        $userCart->increment('quantity', 1);
                    } else {
                        $userCart = new UserCart();
                        $userCart->user_id = auth()->user()->id;
                        $userCart->product_id = $id;
                        $userCart->quantity = 1;
                        $userCart->save();
                    }
                }
            } else {
                return $this->dispatch('warning-flash', ['message' => 'Requested quantity exceeds available stock!']);
            }
        } else {
            $cart[$id] = [
                'product_id' => $product->id,
                'quantity' => 1,
                'image' => $product->thumbphotos,
                'product_name' => $product->product_name,
                'net_amount' => 1 * $product->sale_price,
                'rate' => $product->sale_price,
                'stock' => $product->stock,
            ];
            if (auth()->check()) {
                $userCart = UserCart::where('user_id', auth()->user()->id)->where('product_id', $id)->first();
                if ($userCart) {
                    $userCart->increment('quantity', 1);
                } else {
                    $userCart = new UserCart();
                    $userCart->user_id = auth()->user()->id;
                    $userCart->product_id = $product->id;
                    $userCart->quantity = 1;
                    $userCart->save();
                }
            }
        }
        session()->put('cart', $cart);
        $this->carts = $cart;
        $this->dispatch('addCartItems');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.productlists');
    }
}
