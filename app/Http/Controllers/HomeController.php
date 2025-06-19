<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Slider;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get distinct store names only
        $stores = Stores::with('user')
                    ->select('id', 'name', 'slug', 'category_id', 'image')
                    ->distinct()
                    ->get();
        $sliders = Slider::where('status', 1)
                    ->orderBy('sort_order', 'asc')
                    ->get();
        $categories = Category::where('top_category', 1)
                    ->get();
        $coupons = Coupon::with('user')
                    ->where('status', 1)
                    ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                    ->get();
        return view('welcome', compact('stores', 'sliders', 'categories', 'coupons'));
    }
    public function stores(Request $request)
    {
        // Get distinct store names only
        $stores = Stores::all();
        return view('stores', compact('stores'));
    }

    public function store_detail($name)
    {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
        $store = Stores::where('slug', $title)->first();

        if (!$store) {
            return redirect('404');
        }

        // Get coupons where store_id matches the store's ID
        $coupons = Coupon::with('user')
                    ->where('store_id', $store->id)
                    ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                    ->get();
        return view('store_detail', compact('store', 'coupons'));
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
