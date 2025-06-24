<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\language;
use App\Models\Slider;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $lang = null)
    {
        $languageCode = $lang ?? 'en';
        app()->setLocale($languageCode);

        // Fetch the language, or default to English
        $language = language::where('code', $languageCode)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter all models by language_id
        $stores = Stores::select('id', 'name', 'slug', 'category_id', 'image')
            ->where('language_id', $language->id)
            ->distinct()
            ->limit(10)
            ->get();

        $sliders = Slider::where('status', 1)
            ->where('language_id', $language->id)
            ->orderBy('sort_order', 'asc')
            ->get();

        $categories = Category::where('top_category', 1)
            ->where('language_id', $language->id)
            ->get();

        $coupons = Coupon::with('user')
            ->where('status', 1)
            ->where('language_id', $language->id)
            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
            ->get();

        return view('welcome', compact('stores', 'sliders', 'categories', 'coupons'));
    }

    public function stores(Request $request , $lang = 'en')
    {
        app()->setLocale($lang);
        // Set the locale based on the provided language code
        $language = language::where('code', $lang)->first();
        if (!$language) {
            abort(404, 'Language not found');
        }

        // Filter stores by language_id
        $stores = Stores::where('language_id', $language->id)
                        ->distinct()
                        ->get();

        return view('stores', compact('stores'));
    }


    public function store_detail(Request $request, $slug, $lang = 'en')
    {
        app()->setLocale($lang);

        $store = Stores::with('language')->where('slug', $slug)->first();

        if (!$store) {
            abort(404); // Store not found
        }

        if (!$store->language) {
            return response()->json(['error' => 'No language selected for this store.'], 404);
        }

        if ($lang !== $store->language->code) {
            return redirect()->route('store_details.withLang', [
                'lang' => $store->language->code,
                'slug' => $slug
            ]);
        }

        $sort = $request->query('sort', 'all');
        $couponsQuery = Coupon::where('store_id', $store->id)
                            ->where('language_id', $store->language_id)
                            ->orderByRaw('CAST(`order` AS SIGNED) ASC');

        if ($sort === 'codes') {
            $couponsQuery->whereNotNull('code');
        } elseif ($sort === 'deals') {
            $couponsQuery->whereNull('code');
        }

        $coupons = $couponsQuery->get();

        $codeCount = Coupon::where('store_id', $store->id)
                        ->whereNotNull('code')
                        ->where('language_id', $store->language_id)
                        ->count();

        $dealCount = Coupon::where('store_id', $store->id)
                        ->whereNull('code')
                        ->where('language_id', $store->language_id)
                        ->count();

        $relatedStores = Stores::where('category_id', $store->category_id)
                            ->where('id', '!=', $store->id)
                            ->where('language_id', $store->language_id)
                            ->get();

        return view('store_detail', compact('store', 'coupons', 'relatedStores', 'codeCount', 'dealCount'));
    }

    public function category($lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter categories by language_id
        $categories = Category::where('language_id', $language->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('category', compact('categories'));
    }

    public function category_detail($name = null, $lang)
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        if (!$name) {
            return redirect('404');
        }
        // Fetch the category by name and language_id
        $category = Category::where('name', $name)
                            ->where('language_id', $language->id)
                            ->firstOr(function () {
            abort(404, 'Category not found');
        });
        // Filter stores by category_id and language_id
        $stores = Stores::where('category_id', $category->id)
                        ->where('language_id', $language->id)
                        ->distinct()
                        ->get();
        return view('category_detail', compact('category', 'stores'));
    }

    public function blog($lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter blogs by language_id and status
        $blogs = Blog::with('language')
            ->where('language_id', $language->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('blog', compact('blogs'));
    }

    public function blog_detail($slug, $lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Fetch the blog by slug and language_id
        $blog = Blog::with('language')
            ->where('slug', $slug)
            ->where('language_id', $language->id)
            ->firstOr(function () {
                abort(404, 'Blog not found');
            });
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->where('language_id', $language->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('blog_detail', compact('blog', 'relatedBlogs'));
    }


}
