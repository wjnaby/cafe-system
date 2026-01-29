@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Menu Item</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Item Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $menuItem->name) }}" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-amber-500 focus:border-amber-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-amber-500 focus:border-amber-500">{{ old('description', $menuItem->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Price -->
            <div class="mb-6">
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($) *</label>
                <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $menuItem->price) }}" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-amber-500 focus:border-amber-500">
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Category -->
            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                <select name="category_id" id="category_id" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $menuItem->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                <select name="status" id="status" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="active" {{ old('status', $menuItem->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $menuItem->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Current Image -->
            @if($menuItem->image)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                    <img src="{{ asset('images/menu/'.$menuItem->image) }}" alt="{{ $menuItem->name }}" class="h-32 w-32 object-cover rounded">
                </div>
            @endif
            
            <!-- New Image -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Change Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-amber-500 focus:border-amber-500">
                <p class="mt-1 text-sm text-gray-500">Leave empty to keep current image</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.menu.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-amber-500 text-white rounded-md hover:bg-amber-600">
                    Update Item
                </button>
            </div>
        </form>
    </div>

</div>
@endsection