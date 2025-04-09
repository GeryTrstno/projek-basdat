<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil satu user dan satu category dari database
        $user = User::first();
        $category = Category::first();

        // Buat product
        Product::create([
            'name' => 'Iphone 11',
            'slug' => Str::slug('Iphone 11') . '-' . Str::random(5),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus eaque earum eius error excepturi ipsum minus quasi. Asperiores aut eius fuga id ipsum minus perspiciatis repellat sapiente tempore vitae! Dolore.',
            'price' => 8990000,
            'amount' => 15,
            'image' => 'img/gambar-dummy.jpeg', // pastikan file ini ada di public/img/
            'seller_id' => $user->id,
            'category_id' => $category->id,
        ]);
    }
}
