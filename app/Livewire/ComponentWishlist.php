<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use App\Livewire\Productlists;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ComponentWishlist extends Component
{
    public $wishlist ;
    protected $listeners = ['addCartItems', 'cartItems', 'wishlistUpdated'];


    public function mount()
    {
        $this->loadWishlist();
    }

    public function loadWishlist()
    {
        if (Auth::check()) {
            $this->wishlist = Wishlist::where('user_id', Auth::user()->id)
                ->with('product')
                ->get();
        }
    }

    public function addToWishlist($productId)
    {
        if (Auth::check()) {
            $product = Product::find($productId);
            if ($product) {
                $userId = Auth::user()->id;
                $wishlist = Wishlist::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

                if (!$wishlist) {
                    Wishlist::create([
                        'product_id' => $productId,
                        'user_id' => $userId,
                    ]);
                    session()->flash('success', 'Product added to wishlist successfully!');
                } else {
                    session()->flash('warning', 'Product is already in the wishlist!');
                }
            } else {
                session()->flash('warning', 'Product does not exist');
            }
        } else {
            session()->flash('warning', 'User not authenticated');
        }
        $this->dispatch('addCartItems');
        $this->loadWishlist(); // Refresh the wishlist view

    }

    public function removeFromWishlist($wishlistId)
    {
        $wishlist = Wishlist::find($wishlistId);
        if ($wishlist) {
            $wishlist->delete();
            session()->flash('success', 'Product deleted from wishlist successfully!');
        } else {
            session()->flash('warning', 'Record does not exist in wishlist');
        }

        $this->loadWishlist();
        $this->dispatch('addCartItems');
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

    public function addToCart($id)
    {
        (new Productlists())->addToCart($id);
        $this->dispatch('addCartItems');
    }

    public function render()
    {
        return view('livewire.component-wishlist', [
            'wishlistProduct' => $this->wishlist,
            'cart' => Session::get('cart'),
        ]);
    }
}
