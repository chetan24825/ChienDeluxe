<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\UserCart;
use Illuminate\Support\Facades\Session;

class Carts extends Component
{
    protected $listeners = ['addCartItems', 'render'];

    public $carts;
    public $quantity;

    public function mount()
    {
        $this->cartlist();
    }

    public function cartlist()
    {
        $this->carts  = session()->get('cart');
    }

    public function decrementQty($id)
    {
        $cart = Session::get('cart');
        if (isset($cart[$id])) {
            $product = Product::findOrFail($id);
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                $cart[$id]['net_amount'] = $product->sale_price * $cart[$id]['quantity'];

                if (auth()->check()) {
                    $userCart = UserCart::where('user_id', auth()->user()->id)->where('product_id', $id)->first();
                    if ($userCart) {
                        $userCart->decrement('quantity', 1);
                    } else {
                        $userCart = new UserCart();
                        $userCart->user_id = auth()->user()->id;
                        $userCart->product_id = $id;
                        $userCart->quantity = 1;
                        $userCart->save();
                    }
                }
            } else {
                return $this->dispatch('warning-flash', ['message' => 'Minimum Quantity 1 is Required']);
            }
        }

        session()->put('cart', $cart);
        $this->carts = $cart;
        $this->dispatch('addCartItems');
        $this->dispatch('decrementQty', $id);
        redirect()->back();
    }


    public function incrementQty($id)
    {
        $cart = Session::get('cart');
        if (isset($cart[$id])) {
            $product = Product::findOrFail($id);
            if (($cart[$id]['quantity'] < $product->stock)) {
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
        }

        session()->put('cart', $cart);
        $this->carts = $cart;
        $this->dispatch('addCartItems');
        $this->dispatch('incrementQty', $id);
        redirect()->back();
    }

    public function tocarddelete($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        if (auth()->check()) {
            $userCart = UserCart::where('user_id', auth()->user()->id)->where('product_id', $productId)->first();
            if ($userCart) {
                $userCart->delete();
            }
        }
        session()->put('cart', $cart);
        $this->carts = $cart;
        $this->dispatch('addCartItems');
        $this->dispatch('show-flash', ['message' => 'Remove Successfully']);
        redirect()->back();
    }

    function addToWishlist($id)
    {
        (new ComponentWishlist())->addToWishlist($id);
        $this->dispatch('addCartItems');
    }


    public function render()
    {
        return view('livewire.carts');
    }
}
