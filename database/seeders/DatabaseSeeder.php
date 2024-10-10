<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        Category::truncate();
        $categories = ['Buy', 'Sale', 'Rent'];
        foreach($categories as $category) {
            Category::create(['name' => $category]);
        }

        Post::factory(20)->create();

    }
}
