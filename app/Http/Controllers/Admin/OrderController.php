<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show all orders
    public function index()
    {
        $orders = Order::with('user', 'orderItems.menuItem')
                       ->orderBy('created_at', 'desc')
                       ->get();
        
        return view('admin.orders.index', compact('orders'));
    }

    // Show order details
    public function show($id)
    {
        $order = Order::with('user', 'orderItems.menuItem')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,completed',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated!');
    }
}