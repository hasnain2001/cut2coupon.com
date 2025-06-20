<?php

use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\ChatMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
 
    Route::get('/privacy', function () { return view('privacy'); })->name('privacy');
    Route::get('/terms', function () { return view('terms'); })->name('terms');
    Route::get('/about', function () { return view('about'); })->name('about');

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('contact');
        Route::post('/contact', 'store')->name('contact.store');
    });


    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/stores', 'stores')->name('stores');
        Route::get('/store/{slug}', 'store_detail')->name('store.detail');
        Route::get('/category', 'category')->name('category');
        Route::get('/category/{slug}', 'category_detail')->name('category.detail');
        Route::get('/coupons', 'coupons')->name('coupons');
        Route::get('/blog', 'blog')->name('blog');
        Route::get('/search', 'search')->name('search');

     });

     Route::controller(CouponController::class)->group(function () {
        Route::post('/update-clicks', 'updateClicks')->name('update.clicks');
        Route::get('/clicks/{couponId}',  'openCoupon')->name('open.coupon');
     });


    Route::middleware(['auth','role:web'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    });

    Route::get('/chat', function () { $users = User::where('id', '!=', Auth::id())->get();return view('chat-list', compact('users'));})->middleware('auth')->name('chat-list');

    Route::get('/chat/{id}', function ($id) {$receiver = User::findOrFail($id);return view('chat', compact('receiver'));})->middleware('auth')->name('chat');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';
require __DIR__.'/artisan.php';

