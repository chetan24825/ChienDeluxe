<?php

namespace App\Livewire;

use App\Models\Coupon;
use App\Models\Product;
use Livewire\Component;
use App\Models\UserCart;
use Illuminate\Support\Facades\Session;

class Carts extends Component
{
    protected $listeners = ['addCartItems', 'render'];

    public $carts;
    public $quantity;
    public $promoCode;
    public $message;
    public $promoCodeSession;

    public function mount()
    {
        $this->cartlist();
    }

    public function cartlist()
    {
        $this->promoCodeSession = session()->get('promoCodes');
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



    public function applyPromoCode()
    {
        $this->validate([
            'promoCode' => 'required|string',
        ]);

        $promoCode = Coupon::where('coupen_name', $this->promoCode)
            ->where('valid_for_date', '>', now())
            ->where('status', 1)
            ->first();

        if ($promoCode) {
            $this->message = "<em class='text-success'>Promo code applied successfully! {$promoCode->coupen_amount}% discount applied</em>";
            $promoCodes = session()->get('promoCodes', []);
            $promoCodes['promoCode'] = [
                'id' => $promoCode->id,
                'code' => $promoCode->coupen_name,
                'amount' => $promoCode->coupen_amount,
                'status' => $promoCode->status,
                'expiry' => $promoCode->valid_for_date,
            ];
            session()->put('promoCodes', $promoCodes);
            $this->cartlist();
            $this->dispatch('addCartItems');
        } else {
            $this->message = "<em class='text-danger'>Invalid promo code!</em>";
        }
    }


    function removePromoCode()
    {
        session()->forget('promoCodes');
        $this->cartlist();
        $this->dispatch('addCartItems');
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
