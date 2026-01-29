@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-6">
        <a href="{{ route('admin.customers.index') }}" class="text-amber-600 hover:text-amber-700">
            ← Back to Customers
        </a>
    </div>

    <!-- Customer Info Card -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-8">
            <div class="flex items-center">
                <div class="h-20 w-20 bg-white rounded-full flex items-center justify-center">
                    <span class="text-4xl font-bold text-amber-600">{{ strtoupper(substr($customer->name, 0, 1)) }}</span>
                </div>
                <div class="ml-6 text-white">
                    <h1 class="text-3xl font-bold">{{ $customer->name }}</h1>
                    <p class="text-amber-100">{{ $customer->email }}</p>
                    <p class="text-sm text-amber-100 mt-1">Member since {{ $customer->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-3 divide-x divide-gray-200">
            <div class="px-6 py-4 text-center">
                <p class="text-sm text-gray-600">Total Orders</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalOrders }}</p>
            </div>
            <div class="px-6 py-4 text-center">
                <p class="text-sm text-gray-600">Total Spent</p>
                <p class="text-2xl font-bold text-green-600 mt-1">${{ number_format($totalSpent, 2) }}</p>
            </div>
            <div class="px-6 py-4 text-center">
                <p class="text-sm text-gray-600">Average Order</p>
                <p class="text-2xl font-bold text-blue-600 mt-1">
                    ${{ $totalOrders > 0 ? number_format($totalSpent / $totalOrders, 2) : '0.00' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Order History -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Order History</h2>
        </div>

        @if($orders->count() === 0)
            <div class="px-6 py-8 text-center">
                <p class="text-gray-500">This customer hasn't placed any orders yet</p>
            </div>
        @else
            <div class="divide-y divide-gray-200">
                @foreach($orders as $order)
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <p class="text-sm text-gray-600">Order #{{ $order->id }}</p>
                                <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y - h:i A') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'preparing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'ready') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <p class="mt-1 text-lg font-bold text-gray-900">${{ number_format($order->total_price, 2) }}</p>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm font-medium text-gray-700 mb-2">Items:</p>
                            <div class="space-y-2">
                                @foreach($order->orderItems as $item)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-700">{{ $item->quantity }}x {{ $item->menuItem->name }}</span>
                                        <span class="text-gray-900 font-medium">${{ number_format($item->price * $item->quantity, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View Full Details →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
