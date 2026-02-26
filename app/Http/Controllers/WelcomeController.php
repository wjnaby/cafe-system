<?php

namespace App\Http\Controllers;

use App\Models\CafeSetting;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index()
    {
        try {
            $settings = CafeSetting::getAllSettings();
            $featuredItems = MenuItem::where('status', 'active')
                ->with('category')
                ->take(6)
                ->get();
            $categories = Category::withCount(['menuItems' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        } catch (\Throwable $e) {
            Log::warning('Welcome page: database unavailable or tables missing.', [
                'message' => $e->getMessage(),
            ]);
            $settings = [];
            $featuredItems = collect();
            $categories = collect();
        }

        return view('welcome', compact('settings', 'featuredItems', 'categories'));
    }
}
