<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;

class ComponentWishlistCount extends Component
{
    protected $listeners = ['addCartItems', 'render'];

    public $wishlistCount = 0;

    public function mount()
    {
        $this->loadWishlistCount();
    }

    public function loadWishlistCount()
    {
        if (auth()->check()) {
            $this->wishlistCount = Wishlist::where('user_id', auth()->user()->id)
                ->count();
        } else {
            $this->wishlistCount = 0; // Set to 0 if not authenticated
        }

    }

    public function render()
    {
        return view('livewire.component-wishlist-count', [
            'wishlistCount' => $this->wishlistCount, // Pass the wishlist count to the view
        ]);
    }
}
