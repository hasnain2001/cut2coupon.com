<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\language;
use App\Models\Stores;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
        public function index(){
        $stores = Stores::all();
        $categories = Category::all();
        return view('sitemap',compact('stores','categories'));
    }
        public function generate()
    {
        $sitemap = Sitemap::create();

        // Define available locales
        $locales = language::pluck('code')->toArray();

        // Static pages
        $staticRoutes = [
            'blog' => 1.0,
            'stores' => 1.0,
            'categories' => 1.0,
            'about' => 0.8,
            'contact' => 0.8,
            'terms-and-condition' => 0.8,
            'privacy' => 0.8,
            'cookies' => 0.8,
            'imprint' => 0.8,
        ];

        foreach ($locales as $locale) {
            foreach ($staticRoutes as $route => $priority) {
                $sitemap->add(Url::create("/$locale/$route")->setPriority($priority));
            }
        }

        // Dynamic URLs: Stores
        $stores = Stores::all();
        foreach ($stores as $store) {
            $slug = Str::slug($store->slug);
            foreach ($locales as $locale) {
                if ($locale == 'en') {
                    $sitemap->add(Url::create("/store/{$slug}"));
                } else {
                    $sitemap->add(Url::create("/$locale/store/{$slug}"));
                }
            }
        }
    // Dynamic URLs: Stores
    $blogs = Blog::all();
    foreach ($blogs as $blog) {
        $slug = Str::slug($blog->slug);
        foreach ($locales as $locale) {
            $sitemap->add(Url::create("/$locale/blog/{$slug}"));
        }
    }
     $categories = Category::all();
    foreach ($categories as $category) {
        $slug = Str::slug($category->slug);
        foreach ($locales as $locale) {
            $sitemap->add(Url::create("/$locale/category/{$slug}"));
        }
    }

        // Save the sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return redirect()->route('sitemap')->with('success', 'Sitemap created successfully.');
    }

}
