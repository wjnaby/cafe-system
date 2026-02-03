<?php

namespace App\Http\Controllers;

use App\Models\CafeSetting;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get all cafe settings
        $settings = CafeSetting::getAllSettings();
        
        // Get featured menu items (first 6 active items)
        $featuredItems = MenuItem::where('status', 'active')
            ->with('category')
            ->take(6)
            ->get();
        
        // Get categories with their item counts
        $categories = Category::withCount(['menuItems' => function ($query) {
            $query->where('status', 'active');
        }])->get();
        
        return view('welcome', compact('settings', 'featuredItems', 'categories'));
    }
}
