<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // View all orders
    public function index()
    {
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // View order details
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|in:pending,processing,completed'
        ]);

        // Find the order
        $order = Order::findOrFail($id);

        // Update the status
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order #' . $order->id . ' status updated to ' . $request->status);
    }
}