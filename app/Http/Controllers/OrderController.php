<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Show user's orders
    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id())
                      ->with('orderItems.menuItem');
        
        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();
        
        return view('orders.index', compact('orders'));
    }

    // Place order
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Calculate total
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Use transaction to ensure data integrity
        DB::beginTransaction();
        try {
            // Create order with notes
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Clear cart
            session()->forget('cart');
            
            DB::commit();
            
            return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}