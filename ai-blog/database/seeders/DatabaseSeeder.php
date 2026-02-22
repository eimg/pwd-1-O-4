<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create predefined users
        $alice = User::factory()->alice()->create();
        $bob = User::factory()->bob()->create();

        // Create predefined categories
        $categories = [
            'News' => Category::create(['name' => 'News']),
            'Tech' => Category::create(['name' => 'Tech']),
            'App' => Category::create(['name' => 'App']),
            'Mobile' => Category::create(['name' => 'Mobile']),
            'Api' => Category::create(['name' => 'Api']),
        ];

        // Create 20 sample posts
        $posts = collect();
        for ($i = 1; $i <= 20; $i++) {
            $post = Post::create([
                'title' => fake()->sentence(6, true),
                'body' => fake()->paragraphs(5, true),
                'feature_image' => 'https://picsum.photos/800/600?random=' . $i,
                'category_id' => fake()->randomElement($categories)->id,
                'user_id' => fake()->randomElement([$alice->id, $bob->id]),
            ]);
            $posts->push($post);
        }

        // Create 40 sample comments
        for ($i = 1; $i <= 40; $i++) {
            Comment::create([
                'content' => fake()->paragraph(),
                'post_id' => fake()->randomElement($posts)->id,
                'user_id' => fake()->randomElement([$alice->id, $bob->id]),
            ]);
        }
    }
}
