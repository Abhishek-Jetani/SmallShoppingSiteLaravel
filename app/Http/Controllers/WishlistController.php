<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth()->user()->id)->get();
        $cartItems = Cart::where('user_id', Auth()->user()->id)->pluck('product_id')->toArray();
        return view('wishlist.index', compact('wishlists', 'cartItems'));
    }

    public function destroy(Wishlist $wishlist)
    {
        try {
            $result = deleteItem(Wishlist::class, $wishlist->id, null);

            if ($result['success']) {
                return redirect()->back()->with('success', 'Product removed successfully');
            } else {
                return redirect()->back()->with('error', $result['message']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please refresh the page');
        }
    }
}
