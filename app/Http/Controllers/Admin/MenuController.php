<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Show all menu items
    public function index()
    {
        $menuItems = MenuItem::with('category')->get();
        return view('admin.menu.index', compact('menuItems'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.menu.create', compact('categories'));
    }

    // Store new menu item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/menu'), $imageName);
            $data['image'] = $imageName;
        }

        MenuItem::create($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item created!');
    }

    // Show edit form
    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $categories = Category::all();
        return view('admin.menu.edit', compact('menuItem', 'categories'));
    }

    // Update menu item
    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
        if($request->hasFile('image')) {
            // Delete old image
            if($menuItem->image) {
                @unlink(public_path('images/menu/'.$menuItem->image));
            }
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/menu'), $imageName);
            $data['image'] = $imageName;
        }

        $menuItem->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated!');
    }

    // Delete menu item
    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        
        // Delete image
        if($menuItem->image) {
            @unlink(public_path('images/menu/'.$menuItem->image));
        }
        
        $menuItem->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted!');
    }

    // Toggle menu item status
    public function toggle($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        
        // Toggle status
        $menuItem->status = $menuItem->status === 'active' ? 'inactive' : 'active';
        $menuItem->save();
        
        $message = $menuItem->status === 'active' ? 'Menu item is now available!' : 'Menu item is now unavailable!';
        
        return redirect()->back()->with('success', $message);
    }
}