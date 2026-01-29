@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

    @if(empty($cart))
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <p class="text-gray-600 text-lg">Your cart is empty</p>
            <a href="{{ route('menu.index') }}" class="mt-4 inline-block bg-amber-500 text-white px-6 py-2 rounded-md hover:bg-amber-600">
                Browse Menu
            </a>
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            
            <!-- Cart Items -->
            <div class="divide-y divide-gray-200">
                @foreach($cart as $id => $item)
                    <div class="p-6 flex items-center">
                        
                        <!-- Item Image -->
                        <div class="h-20 w-20 flex-shrink-0 bg-gray-200 rounded flex items-center justify-center">
                            @if(isset($item['image']) && $item['image'])
                                <img src="{{ asset('images/menu/'.$item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover rounded">
                            @else
                                <span class="text-3xl">☕</span>
                            @endif
                        </div>
                        
                        <!-- Item Details -->
                        <div class="ml-6 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $item['name'] }}</h3>
                            <p class="text-gray-600">${{ number_format($item['price'], 2) }} each</p>
                        </div>
                        
                        <!-- Quantity -->
                        <div class="flex items-center space-x-3">
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-20 border border-gray-300 rounded px-3 py-1 text-center" onchange="this.form.submit()">
                            </form>
                        </div>
                        
                        <!-- Subtotal -->
                        <div class="ml-6 text-right">
                            <p class="text-lg font-semibold text-gray-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                        
                        <!-- Remove Button -->
                        <div class="ml-6">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Total and Checkout -->
            <div class="bg-gray-50 px-6 py-4">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xl font-semibold text-gray-900">Total:</span>
                    <span class="text-2xl font-bold text-amber-600">${{ number_format($total, 2) }}</span>
                </div>
                
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    
                    <!-- Order Notes Field -->
                    <div class="mb-4">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Special Requests (Optional)
                        </label>
                        <textarea name="notes" id="notes" rows="3" 
                            placeholder="E.g., Less sugar, No ice, Extra spicy..."
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-amber-500 focus:border-amber-500"></textarea>
                        <p class="mt-1 text-xs text-gray-500">Any special instructions for your order</p>
                    </div>
                    
                    <button type="submit" class="w-full bg-amber-500 text-white py-3 rounded-md text-lg font-semibold hover:bg-amber-600 transition">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    @endif

</div>
@endsection