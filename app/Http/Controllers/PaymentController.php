<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function processCheckout(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => 1000, // Amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Test payment',
            ]);

            // You can add code to handle successful payment here

            return back()->with('success_message', 'Payment successful!');
        } catch (\Exception $ex) {
            return back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
}
