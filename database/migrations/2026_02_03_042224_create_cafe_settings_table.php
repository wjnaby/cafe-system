<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cafe_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('cafe_settings')->insert([
            ['key' => 'cafe_name', 'value' => 'Cafe System', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'hero_title', 'value' => 'Freshly Baked, Just for You!', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'hero_subtitle', 'value' => 'Experience the finest selection of artisan breads, sweet pastries, and custom cakes made with love and the finest ingredients.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'hero_image', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'about_title', 'value' => 'Why Choose Us?', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'about_description', 'value' => 'We pride ourselves on using only the finest ingredients, traditional recipes passed down through generations, and a passion for creating memorable experiences for our customers.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'feature_1_title', 'value' => 'Artisan Breads', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'feature_1_description', 'value' => 'Handcrafted daily using traditional methods and the finest flour.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'feature_1_image', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'feature_2_title', 'value' => 'Sweet Pastries', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'feature_2_description', 'value' => 'Delightful treats made fresh every morning with premium ingredients.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'feature_2_image', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'feature_3_title', 'value' => 'Custom Cakes', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'feature_3_description', 'value' => 'Beautiful custom cakes for every occasion, made to order.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'feature_3_image', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'visit_title', 'value' => 'Visit Us Today', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'visit_description', 'value' => 'Come experience the aroma of freshly baked goods and the warmth of our welcoming cafe. We\'re open daily to serve you the best.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'visit_image', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'address', 'value' => '123 Baker Street, Downtown', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'phone', 'value' => '+1 (555) 123-4567', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'email', 'value' => 'hello@cafesystem.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'opening_hours', 'value' => 'Mon-Fri: 7am-8pm, Sat-Sun: 8am-9pm', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafe_settings');
    }
};
