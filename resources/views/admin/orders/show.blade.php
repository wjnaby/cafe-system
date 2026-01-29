@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-amber-600 hover:text-amber-700">
            ← Back to Orders
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        
        <!-- Order Header -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                    <p class="text-sm text-gray-600 mt-1">Placed on {{ $order->created_at->format('M d, Y - h:i A') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($order->total_price, 2) }}</p>
                </div>
            </div>
        </div>
        
        <!-- Customer Info -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Customer Information</h3>
            <p class="text-gray-700">Name: {{ $order->user->name }}</p>
            <p class="text-gray-700">Email: {{ $order->user->email }}</p>
        </div>
        
        <!-- Order Items -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h3>
            <div class="space-y-3">
                @foreach($order->orderItems as $item)
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-900 font-medium">{{ $item->menuItem->name }}</p>
                            <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                        </div>
                        <p class="text-gray-900 font-semibold">${{ number_format($item->price * $item->quantity, 2) }}</p>
                    </div>
                @endforeach
            </div>
            
            <!-- Show customer notes -->
            @if($order->notes)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Customer Notes:</h4>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                        <p class="text-gray-700">{{ $order->notes }}</p>
                    </div>
                </div>
            @endif
            
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-900">Total:</span>
                    <span class="text-xl font-bold text-gray-900">${{ number_format($order->total_price, 2) }}</span>
                </div>
            </div>
        </div>
        
        <!-- Update Status -->
        <div class="px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Order Status</h3>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="flex items-center space-x-4">
                    <select name="status" class="flex-1 border border-gray-300 rounded-md px-4 py-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Ready</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    
                    <button type="submit" class="px-6 py-2 bg-amber-500 text-white rounded-md hover:bg-amber-600">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection