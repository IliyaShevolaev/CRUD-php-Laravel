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
        //Post::factory(10)->create();
        
        Category::truncate();
        $categories = ['Покупка', 'Продажа', 'Аренда'];
        foreach($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
