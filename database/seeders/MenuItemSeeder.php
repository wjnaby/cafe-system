<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run()
    {
        $menuItems = [
            // Coffee
            ['name' => 'Espresso', 'description' => 'Strong and bold coffee', 'price' => 5.00, 'category_id' => 1, 'status' => 'active'],
            ['name' => 'Latte', 'description' => 'Smooth coffee with milk', 'price' => 8.00, 'category_id' => 1, 'status' => 'active'],
            ['name' => 'Cappuccino', 'description' => 'Coffee with foam', 'price' => 8.50, 'category_id' => 1, 'status' => 'active'],
            
            // Food
            ['name' => 'Croissant', 'description' => 'Buttery French pastry', 'price' => 6.00, 'category_id' => 2, 'status' => 'active'],
            ['name' => 'Sandwich', 'description' => 'Fresh ham and cheese', 'price' => 12.00, 'category_id' => 2, 'status' => 'active'],
            
            // Dessert
            ['name' => 'Chocolate Cake', 'description' => 'Rich chocolate cake', 'price' => 10.00, 'category_id' => 3, 'status' => 'active'],
            ['name' => 'Cheesecake', 'description' => 'Creamy cheesecake', 'price' => 11.00, 'category_id' => 3, 'status' => 'active'],
            
            // Beverages
            ['name' => 'Orange Juice', 'description' => 'Fresh squeezed orange', 'price' => 7.00, 'category_id' => 4, 'status' => 'active'],
            ['name' => 'Iced Tea', 'description' => 'Refreshing iced tea', 'price' => 6.00, 'category_id' => 4, 'status' => 'active'],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }
    }
}