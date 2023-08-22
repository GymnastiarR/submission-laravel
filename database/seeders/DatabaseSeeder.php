<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Programming',
            'slug' => 'programming',
        ]);

        \App\Models\Tag::factory()->create([
            'name' => 'PHP',
            'slug' => 'php',
        ]);

        \App\Models\Tag::factory()->create([
            'name' => 'Laravel',
            'slug' => 'laravel',
        ]);

        \App\Models\Article::factory()->create([
            'author_id' => 1, // 'Test User',
            'category_id' => 1, // 'Programming',
            'title' => 'Test Article',
            'slug' => 'test-article',
            'content' => 'This is a test article.',
        ]);
    }
}
