<?php

namespace App\Http\Controllers;

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

    public function category()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

public function category_detail($name)
    {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
        $category = Category::where('slug', $title)->first();

        if (!$category) {
            return redirect('404');
        }

    $stores = Stores::with('user')
                ->where('category_id', $category->id)
                ->get();
        return view('category_detail', compact('category', 'stores'));
    }
}
