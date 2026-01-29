<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Coffee'],
            ['name' => 'Food'],
            ['name' => 'Dessert'],
            ['name' => 'Beverages'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}