<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        $cartItems = Cart::all();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->sneaker->price * $item->quantity;
        });
        return view('checkout', compact('cartItems','totalPrice'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::all();

        if ($cartItems->isEmpty()) {
            return redirect()->route('checkout.show')->with('error', 'Your cart is empty.');
        }

        $totalPrice = 0;
         

        foreach ($cartItems as $cartItem) {
            $sneaker = $cartItem->sneaker;
            $totalPrice += $cartItem->quantity * $sneaker->price;

            // Create an order for each cart item
            Order::create([
                'user_id' => $user->id,
                'sneaker_id' => $cartItem->sneaker_id,
                'quantity' => $cartItem->quantity,
                'total_price' => $cartItem->quantity * $sneaker->price,
            ]);

            // Update sneaker stock
            $sneaker->stock -= $cartItem->quantity;
            $sneaker->save();
        }

        // Save payment information
        PaymentInfo::create([
            'user_id' => $user->id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code'),
            'credit_card_no' => $request->input('credit_card_no'),
            'exp' => $request->input('exp'),
            'ccv' => $request->input('ccv'),
        ]);

        // Clear the cart
        // Cart::where('session_id', Session::getId())->delete();
        Cart::truncate();

        // return redirect()->route('home')->with('success', 'Your order has been placed successfully.');
        return redirect()->route('order.confirmation');
    }

    public function showOrderConfirmation()
    {
        $user = Auth::user();
        $recentOrder = Order::where('user_id', $user->id)->latest()->first();
        return view('order_confirmation', compact('recentOrder'));
    }
    
}
