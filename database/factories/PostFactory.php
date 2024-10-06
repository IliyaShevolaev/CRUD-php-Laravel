<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'content' => fake()->paragraph(1),
            'price' => random_int(1, 50000),
            'category_id' => random_int(1, 3),
            'owner_id' => 0,
        ];
    }
}
