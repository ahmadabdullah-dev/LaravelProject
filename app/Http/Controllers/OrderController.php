<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Checkout - convert cart to order
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        $cart->load('items.product');

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $cart->getTotalPrice(),
            'status' => 'pending'
        ]);

        // Create order items from cart items
        foreach ($cart->items as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price
            ]);
        }

        // Clear cart after checkout
        CartItem::where('cart_id', $cart->id)->delete();

        return redirect()->route('orders.history')->with('success', 'Order placed successfully! Your order ID is #' . $order->id);
    }

    // Order history page
    public function history()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $orders->load('items.product');

        return view('orders.history', compact('orders'));
    }
}