<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Show all customers
    public function index()
    {
        $customers = User::where('role', 'customer')
                        ->withCount('orders')
                        ->withSum('orders', 'total_price')
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('admin.customers.index', compact('customers'));
    }

    // Show customer details
    public function show($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        
        $orders = Order::where('user_id', $id)
                      ->with('orderItems.menuItem')
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        $totalSpent = Order::where('user_id', $id)->sum('total_price');
        $totalOrders = Order::where('user_id', $id)->count();
        
        return view('admin.customers.show', compact('customer', 'orders', 'totalSpent', 'totalOrders'));
    }
}
