@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Orders</h1>

    <!-- Status Filter -->
    <div class="mb-6">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('orders.index') }}" 
                class="px-4 py-2 rounded-md {{ !request('status') ? 'bg-amber-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                All Orders
            </a>
            <a href="{{ route('orders.index', ['status' => 'pending']) }}" 
                class="px-4 py-2 rounded-md {{ request('status') === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Pending
            </a>
            <a href="{{ route('orders.index', ['status' => 'preparing']) }}" 
                class="px-4 py-2 rounded-md {{ request('status') === 'preparing' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Preparing
            </a>
            <a href="{{ route('orders.index', ['status' => 'ready']) }}" 
                class="px-4 py-2 rounded-md {{ request('status') === 'ready' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Ready
            </a>
            <a href="{{ route('orders.index', ['status' => 'completed']) }}" 
                class="px-4 py-2 rounded-md {{ request('status') === 'completed' ? 'bg-gray-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Completed
            </a>
        </div>
    </div>

    @if($orders->count() === 0)
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <p class="text-gray-600 text-lg">You haven't placed any orders yet</p>
            <a href="{{ route('menu.index') }}" class="mt-4 inline-block bg-amber-500 text-white px-6 py-2 rounded-md hover:bg-amber-600">
                Browse Menu
            </a>
        </div>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    
                    <!-- Order Header -->
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
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
                    </div>
                    
                    <!-- Order Items -->
                    <div class="px-6 py-4">
                        <div class="space-y-3">
                            @foreach($order->orderItems as $item)
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <span class="text-gray-900 font-medium">{{ $item->quantity }}x</span>
                                        <span class="ml-3 text-gray-700">{{ $item->menuItem->name }}</span>
                                    </div>
                                    <span class="text-gray-900">${{ number_format($item->price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Show Notes if exists -->
                        @if($order->notes)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm font-medium text-gray-700 mb-1">Special Requests:</p>
                                <p class="text-sm text-gray-600 bg-yellow-50 rounded-md p-3">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection