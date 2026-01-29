<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get today's date
        $today = Carbon::today();
        
        // Statistics
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', $today)->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::sum('total_price');
        $todayRevenue = Order::whereDate('created_at', $today)->sum('total_price');
        $totalMenuItems = MenuItem::count();
        $activeMenuItems = MenuItem::where('status', 'active')->count();
        $totalCustomers = User::where('role', 'customer')->count();
        
        // Recent orders
        $recentOrders = Order::with('user')
                             ->orderBy('created_at', 'desc')
                             ->take(10)
                             ->get();
        
        // Orders by status
        $ordersByStatus = [
            'pending' => Order::where('status', 'pending')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'ready' => Order::where('status', 'ready')->count(),
            'completed' => Order::where('status', 'completed')->count(),
        ];
        
        return view('admin.dashboard', compact(
            'totalOrders',
            'todayOrders',
            'pendingOrders',
            'totalRevenue',
            'todayRevenue',
            'totalMenuItems',
            'activeMenuItems',
            'totalCustomers',
            'recentOrders',
            'ordersByStatus'
        ));
    }
}
