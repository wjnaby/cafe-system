<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Get all active menu items with their categories
        $categories = Category::with(['menuItems' => function($query) {
            $query->where('status', 'active');
        }])->get();

        return view('menu.index', compact('categories'));
    }
}