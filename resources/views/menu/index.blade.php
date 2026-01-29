@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Our Menu</h1>
        <p class="mt-2 text-gray-600">Delicious food and drinks await you</p>
    </div>

    <!-- Search and Filter -->
    <div class="mb-8 bg-white rounded-lg shadow p-6">
        <form action="{{ route('menu.index') }}" method="GET">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Search Box -->
                <div class="flex-1">
                    <input type="text" name="search" placeholder="Search menu items..." 
                        value="{{ request('search') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-amber-500 focus:border-amber-500">
                </div>
                
                <!-- Category Filter -->
                <div class="w-full md:w-64">
                    <select name="category" 
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="">All Categories</option>
                        @foreach(\App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit" class="bg-amber-500 text-white px-6 py-2 rounded-md hover:bg-amber-600">
                        Search
                    </button>
                    <a href="{{ route('menu.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300">
                        Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- No Results Message -->
    @php
        $hasItems = false;
        foreach($categories as $category) {
            if($category->menuItems->count() > 0) {
                $hasItems = true;
                break;
            }
        }
    @endphp

    @if(!$hasItems && (request('search') || request('category')))
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <p class="text-gray-600 text-lg">No items found matching your search.</p>
            <a href="{{ route('menu.index') }}" class="mt-4 inline-block text-amber-600 hover:text-amber-700">
                View all menu items
            </a>
        </div>
    @endif

    @foreach($categories as $category)
        @if($category->menuItems->count() > 0)
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $category->name }}</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($category->menuItems as $item)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            
                            <!-- Item Image -->
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                @if($item->image)
                                    <img src="{{ asset('images/menu/'.$item->image) }}" alt="{{ $item->name }}" class="h-full w-full object-cover">
                                @else
                                    <span class="text-6xl">☕</span>
                                @endif
                            </div>
                            
                            <!-- Item Details -->
                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $item->name }}</h3>
                                <p class="text-gray-600 text-sm mt-1">{{ $item->description }}</p>
                                
                                <div class="mt-4 flex items-center justify-between">
                                    <span class="text-2xl font-bold text-amber-600">${{ number_format($item->price, 2) }}</span>
                                    
                                    @auth
                                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-amber-500 text-white px-4 py-2 rounded-md hover:bg-amber-600 transition">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="bg-gray-400 text-white px-4 py-2 rounded-md">
                                            Login to Order
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

</div>
@endsection