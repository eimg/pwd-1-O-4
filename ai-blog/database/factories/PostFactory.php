<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6, true),
            'body' => fake()->paragraphs(5, true),
            'feature_image' => 'https://picsum.photos/800/600?random=' . fake()->numberBetween(1, 1000),
            'category_id' => \App\Models\Category::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
