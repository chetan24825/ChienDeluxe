<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    function towishlist()
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->with('product')->get();
        // dd($wishlist);
        return view('fronts.wishlist.wishlist', compact('wishlist'));
    }

    public function towishlistadd(Request $request)
    {
        if (Auth::check()) {
            $productId = $request->id;
            $product = Product::find($productId);
            if ($product) {
                $userId = Auth::user()->id;
                $wishlist = Wishlist::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

                if (!$wishlist) {
                    $wishlist = new Wishlist();
                    $wishlist->product_id = $productId;
                    $wishlist->user_id = $userId;
                    $wishlist->save();
                    back()->with('success', 'Product added to wishlist successfully!');
                    return response()->json(['success' => true, 'message' => 'Product added to wishlist successfully']);
                } else {
                    back()->with('success', 'Product is already in the wishlist!');
                    return response()->json(['error' => true, 'message' => 'Product is already in the wishlist']);
                }
            } else {
                back()->with('warning', 'Product does not exist');
                return response()->json(['error' => true, 'message' => 'Product does not exist']);
            }
        } else {
            back()->with('warning', 'User not authenticated');
            return response()->json(['error' => true, 'message' => 'User not authenticated']);
        }
    }

    function towishlistdelete(Request $request)
    {
        $wishlist = Wishlist::find($request->id);
        if ($wishlist) {
            $wishlist->delete();
            back()->with('success', 'Product Delete successfully!');
            return response()->json(['success' => true, 'message' => 'Product Delete successfully']);
        }
        back()->with('warning', 'Record doesnot Exist in Wishlist');
        return response()->json(['error' => true, 'message' => 'User not authenticated']);
    }
}
