<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Sneaker;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $cart = Cart::with('cartItems.sneaker')
            ->where('user_id', $validatedData['user_id'])
            ->firstOrFail();

        $order = $cart->user->orders()->create([
            'user_id' => $validatedData['user_id'],
        ]);

        foreach ($cart->cartItems as $cartItem) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'sneaker_id' => $cartItem->sneaker_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->sneaker->price,
            ]);
        }

        // Clear the cart after the order is created
        $cart->cartItems()->delete();

        return response()->json($order);
    }
}
