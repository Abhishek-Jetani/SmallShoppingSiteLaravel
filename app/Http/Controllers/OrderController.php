<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Mail\OrderPlaceMail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{

    public function placeOrder(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'address_line_1' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'mobile_no' => 'required|digits:10',
            ]);

            // Process the order
            $userId = Auth::id();
            $cartItems = Cart::where('user_id', $userId)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
            }

            $invoiceNumber = Carbon::now()->format('YmdHis');
            $outOfStockProducts = [];
            $total_order_price = 0;

            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $productQuantity = $product->quantity;
                $productTitle = $product->title;
                $userQuantity = $cartItem->quantity;

                if ($productQuantity <= 0) {
                    $outOfStockProducts[] = [
                        'title' => $productTitle,
                        'quantity' => $productQuantity,
                    ];
                } elseif ($userQuantity <= 0) {
                    return response()->json(['success' => false, 'message' => 'Please enter at least one quantity'], 400);
                } elseif ($userQuantity > $productQuantity) {
                    return response()->json(['success' => false, 'message' => 'Requested quantity exceeds available quantity'], 400);
                }
            }

            if (count($outOfStockProducts) > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Some products are out of stock',
                    'data' => $outOfStockProducts,
                ], 400);
            }

            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $total_price = $product->price * $cartItem->quantity;

                Order::create([
                    'user_id' => $userId,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'total_price' => $total_price,
                    'invoice_number' => $invoiceNumber,
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'mobile_no' => $request->mobile_no,
                ]);

                $product->quantity -= $cartItem->quantity;
                $product->save();

                $mailData[] = [
                    'title' => $product->title,
                    'quantity' => $cartItem->quantity,
                    'total_price' => $total_price,
                    'image' => $product->image,
                ];
                $total_order_price += $total_price;
                $cartItem->delete();
            }
            $usermail = Auth::user()->email;
            $Total_Order_Price = $total_order_price;

            Mail::to($usermail)->queue(new OrderPlaceMail($mailData, $Total_Order_Price));

            return response()->json(['success' => true, 'message' => 'Order placed successfully']);

        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            Log::error('Error placing order: ', ['exception' => $th]);
            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $th->getMessage()], 500);
        }
    }

    public function getUserOrders()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->with('product')->orderBy('created_at', 'desc')->get();
        $isOrder = $orders->count();
        return view('order.show', compact('orders', 'isOrder'));
    }

    public function user_allorder_pdf()
    {
        $order = Order::where('user_id', Auth()->user()->id)->with('product')->get();
        $totalPrice = $order->sum(function ($order) {
            return $order->product->price * $order->quantity;
        });

        $orders = Order::where('user_id', Auth()->user()->id)->get();
        $user = Auth()->user()->name;

        $pdf = Pdf::loadView('pdf.user.AllOrder_pdf', compact('orders', 'totalPrice', 'user'));
        return $pdf->download();
    }
}
