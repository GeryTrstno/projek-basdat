<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik',
        ]);
        Category::create([
            'name' => 'Furnitur',
            'slug' => 'furnitur',
        ]);
        Category::create([
            'name' => 'Aksesoris',
            'slug' => 'aksesoris',
        ]);
        Category::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
        ]);
        Category::create([
            'name' => 'Hobi',
            'slug' => 'hobi',
        ]);
    }
}
