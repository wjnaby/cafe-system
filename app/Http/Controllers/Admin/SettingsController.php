<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CafeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = CafeSetting::getAllSettings();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cafe_name' => 'required|string|max:255',
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'feature_1_title' => 'required|string|max:255',
            'feature_1_description' => 'required|string',
            'feature_1_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'feature_2_title' => 'required|string|max:255',
            'feature_2_description' => 'required|string',
            'feature_2_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'feature_3_title' => 'required|string|max:255',
            'feature_3_description' => 'required|string',
            'feature_3_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'visit_title' => 'required|string|max:255',
            'visit_description' => 'required|string',
            'visit_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'opening_hours' => 'nullable|string|max:255',
        ]);

        // Text settings
        $textSettings = [
            'cafe_name', 'hero_title', 'hero_subtitle',
            'about_title', 'about_description',
            'feature_1_title', 'feature_1_description',
            'feature_2_title', 'feature_2_description',
            'feature_3_title', 'feature_3_description',
            'visit_title', 'visit_description',
            'address', 'phone', 'email', 'opening_hours'
        ];

        foreach ($textSettings as $key) {
            if ($request->has($key)) {
                CafeSetting::set($key, $request->input($key));
            }
        }

        // Section enabled/disabled toggles
        $sectionToggles = ['hero_enabled', 'features_enabled', 'visit_enabled', 'menu_preview_enabled', 'contact_enabled'];
        foreach ($sectionToggles as $toggle) {
            // Checkbox sends value only when checked, so missing means disabled
            CafeSetting::set($toggle, $request->has($toggle) ? '1' : '0');
        }

        // Image settings
        $imageSettings = [
            'hero_image', 'feature_1_image', 'feature_2_image', 
            'feature_3_image', 'visit_image'
        ];

        foreach ($imageSettings as $key) {
            if ($request->hasFile($key)) {
                // Delete old image if exists
                $oldImage = CafeSetting::get($key);
                if ($oldImage && file_exists(public_path('images/settings/' . $oldImage))) {
                    unlink(public_path('images/settings/' . $oldImage));
                }

                // Store new image
                $file = $request->file($key);
                $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/settings'), $filename);
                CafeSetting::set($key, $filename);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }

    public function deleteImage(Request $request)
    {
        $key = $request->input('key');
        $allowedKeys = ['hero_image', 'feature_1_image', 'feature_2_image', 'feature_3_image', 'visit_image'];
        
        if (!in_array($key, $allowedKeys)) {
            return response()->json(['error' => 'Invalid key'], 400);
        }

        $oldImage = CafeSetting::get($key);
        if ($oldImage && file_exists(public_path('images/settings/' . $oldImage))) {
            unlink(public_path('images/settings/' . $oldImage));
        }
        
        CafeSetting::set($key, null);
        
        return response()->json(['success' => true]);
    }
}
