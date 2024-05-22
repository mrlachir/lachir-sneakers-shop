<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Sneaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('sneaker')->get();
        $totalPrice = $carts->sum(function ($item) {
            return $item->sneaker->price * $item->quantity;
        });

        return view('carts.index', compact('carts', 'totalPrice'));
    }

    public function store(Request $request, Sneaker $sneaker)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if the sneaker is already in the cart
        $existingCart = Cart::where('sneaker_id', $sneaker->id)->first();

        if ($existingCart) {
            // Update quantity if the sneaker is already in the cart
            $existingCart->update([
                'quantity' => $existingCart->quantity + $request->quantity,
            ]);
        } else {
            // Add the sneaker to the cart
            Cart::create([
                'sneaker_id' => $sneaker->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('carts.index')->with('success', 'Sneaker added to cart successfully.');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('carts.index')->with('success', 'Cart updated successfully.');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'Sneaker removed from cart successfully.');
    }
    public function addToCart(Request $request)
    {
        $sneakerName = $request->input('sneakerName');
        $sneaker_id = $request->input('sneaker_id');
        $size = $request->input('size');
        $color = $request->input('color');

        $sneaker = Sneaker::where('name', $sneakerName)
                          ->where('size', $size)
                          ->where('color_code', $color)
                          ->where('stock', '>', 0)
                          ->first();

        if (!$sneaker) {
            return response()->json([
                'message' => 'Sneaker not available or out of stock'
            ], 400);
        }

        $cartItem = Cart::where('sneaker_id', $sneaker->id)->first();

        if ($cartItem) {
            if ($cartItem->quantity >= $sneaker->stock) {
                return response()->json([
                    'message' => 'Cannot add more items to the cart, stock limit reached'
                ], 400);
            }
    
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'sneaker_id' => $sneaker->id,
                'quantity' => 1,
            ]);
        }

        $cartCount = Cart::count();

        return response()->json([
            'message' => 'Item added to cart',
            'cartCount' => $cartCount
        ]);
    }

    public function addToCartFromHome(Request $request)
{
    $sneaker_id = $request->input('sneaker_id');
    $size = $request->input('size');
    $color = $request->input('color');

    $sneaker = Sneaker::findOrFail($sneaker_id);

    if ($sneaker->stock < 1) {
        return response()->json([
            'message' => 'Out of stock',
            'cartCount' => Cart::count()
        ]);
    }

    $cartItem = Cart::where('sneaker_id', $sneaker_id)->first();

    if ($cartItem) {
        if ($cartItem->quantity >= $sneaker->stock) {
            return response()->json([
                'message' => 'Cannot add more items to the cart, stock limit reached',
            ], 400);
        }

        $cartItem->quantity += 1;
        $cartItem->save();
    } else {
        Cart::create([
            'sneaker_id' => $sneaker_id,
            'quantity' => 1,
            
        ]);
    }

    $cartCount = Cart::count();

    return response()->json([
        'message' => 'Item added to cart',
        'cartCount' => $cartCount
    ]);
}
    public function clearCart()
    {
        Cart::truncate();
        return redirect()->route('carts.index')->with('success', 'Cart cleared successfully.');
    }

    public function getCartCount()
    {
        $cartCount = Cart::count();
        return response()->json(['count' => $cartCount]);
    }
}
