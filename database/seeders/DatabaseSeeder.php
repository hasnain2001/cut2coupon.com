<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
             // Example: Create a single user
     Blog::create([
        'user_id' => 1, // Assuming you have a user with
        'category_id' => 1, // Assuming you have a category with ID 1
        'name' => 'Sample Blog Title',
        'slug' => 'sample-blog-title',
        'content' => 'This is a sample blog content.',
        'image' => 'sample-image.jpg',
        'title' => 'Sample Meta Title',
        'meta_description' => 'Sample Meta Description',
        'meta_keyword' => 'sample, blog, keyword',
     ]);
    }
}
