<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Category created successfully!');
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Check if category has menu items
        if ($category->menuItems()->count() > 0) {
            return redirect()->route('admin.menu.index')->with('error', 'Cannot delete category with menu items. Please remove or reassign items first.');
        }
        
        $category->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Category deleted successfully!');
    }
}
