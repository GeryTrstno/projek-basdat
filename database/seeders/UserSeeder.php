<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Gery',
            'email' => 'gery@gmail.com',
            'username' => 'gery',
            'password' => bcrypt('gery'),
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);

        User::factory(5)->create();
    }
}
