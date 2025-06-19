<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     // Example: Create a single user
     Blog::create([
        'title' => 'Sample Blog Title',
        'slug' => 'sample-blog-title',
        'category_id' => 1, // Assuming you have a category with ID 1
        'content' => 'This is a sample blog content.',
        'image' => 'sample-image.jpg',
        'meta_title' => 'Sample Meta Title',
        'meta_description' => 'Sample Meta Description',
        'meta_keyword' => 'sample, blog, keyword',
     ]);


    }
}
