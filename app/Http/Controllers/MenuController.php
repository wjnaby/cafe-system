<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categoryFilter = $request->get('category');
        
        $query = Category::with(['menuItems' => function($q) use ($search) {
            $q->where('status', 'active');
            if ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            }
        }]);
        
        // Filter by category if selected
        if ($categoryFilter) {
            $query->where('id', $categoryFilter);
        }
        
        $categories = $query->get();
        
        return view('menu.index', compact('categories'));
    }
}