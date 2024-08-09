<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;

class ComponentWishlistCount extends Component
{
    protected $listeners = ['addCartItems', 'render', 'wishlistUpdated'];

    public function render()
    {
        return view('livewire.component-wishlist-count', [
            'wishlistCount' => Wishlist::where('user_id', auth()->user()->id)
                ->count() // Pass the wishlist count to the view
        ]);
    }
}
