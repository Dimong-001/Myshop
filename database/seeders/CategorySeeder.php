<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Category::create([
        'name' => 'Electronics',
        'slug' => Str::slug('Electronics'),
        'image' => 'images/categories/electronics.jpg',
        'is_active' => true,
    ]);
    }
}
