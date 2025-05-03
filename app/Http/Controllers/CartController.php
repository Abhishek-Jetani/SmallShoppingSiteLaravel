<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        try {
            $userId = Auth::id();
            $existingCartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

            if (!$existingCartItem) {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => 1,
                ]);
                Product::where('id', $productId)->decrement('quantity', 1);
            }
            return response()->json(['success' => true, 'message' => 'Product added to cart']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function updateQuantity(Request $request, $cartId)
    {
        try {
            $quantity = $request->input('quantity');
            $cart = Cart::find($cartId);

            if (!$cart) {
                return response()->json(['success' => false, 'message' => 'Cart not found'], 404);
            }

            if ($quantity <= 0 || $quantity > 20) {
                return response()->json(['success' => false, 'message' => 'Quantity must be between 1 and 20'], 400);
            }

            $product = $cart->product;

            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Associated product not found'], 404);
            }

            if ($quantity > $product->quantity) {
                if ($product->quantity <= 0) {
                    return response()->json(['success' => false, 'message' => 'Out of stock'], 400);
                }
                $cart->quantity = $product->quantity;
                $cart->save();
                return response()->json(['success' => false, 'message' => 'Requested quantity exceeds available quantity'], 400);
            }

            $cart->quantity = $quantity;
            $cart->save();

            return response()->json([
                'success' => true,
                'message' => 'Cart quantity updated successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        }
    }



    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        $subtotal = $carts->sum(fn ($cart) => $cart->product->price * $cart->quantity);
        $cartcount = Cart::where('user_id', Auth::id())->count();
        $userId = Auth::id();

        return view('cart.index', compact('carts', 'subtotal', 'cartcount'));
    }

    public function isProductInCart($productId)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['in_cart' => $cartItem]);
    }

    public function destroy(Cart $cart)
    {
        try {
            $result = deleteItem(Cart::class, $cart->id, null);

            if ($result['success']) {
                Product::where('id', $cart->product_id)->increment('quantity', 1);
                return redirect()->back()->with('success', 'Product removed');
            } else {
                return redirect()->back()->with('error', $result['message']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please refresh the page');
        }
    }

    public function getCartProductCount(Request $request)
    {
        $cartcount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartcount]);
    }
}
