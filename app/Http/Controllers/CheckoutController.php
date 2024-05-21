<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        // Retrieve the cart items from the session or other identifier
        $cartItems = Cart::all();

        return view('checkout', compact('cartItems'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('session_id', Session::getId())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('checkout.show')->with('error', 'Your cart is empty.');
        }

        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->quantity * $cartItem->sneaker->price;

            Order::create([
                'user_id' => $user->id,
                'sneaker_id' => $cartItem->sneaker_id,
                'quantity' => $cartItem->quantity,
                'total_price' => $cartItem->quantity * $cartItem->sneaker->price,
            ]);
        }

        Cart::where('session_id', Session::getId())->delete();

        return redirect()->route('home')->with('success', 'Your order has been placed successfully.');
    }
}
