<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;



 Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        return redirect()->back()->with('success', 'Cache cleared successfully!');
    })->name('clear.cache');
    Route::get('/optimize', function () {
       Artisan::call('optimize');
        return redirect()->back()->with('success', 'Application optimized successfully!');
    })->name('optimize');
    Route::get('/config-cache', function () {
        Artisan::call('config:cache');
        return redirect()->back()->with('success', 'Configuration cache cleared successfully!');
    })->name('config.cache');
    Route::get('/view-clear', function () {
        Artisan::call('view:clear');
        return redirect()->back()->with('success', 'View cache cleared successfully!');
    })->name('view.clear');
    Route::get('/route-cache', function () {
        Artisan::call('route:cache');
        return redirect()->back()->with('success', 'Route cache cleared successfully!');
    })->name('route.cache');
    Route::get('/route-clear', function () {
        Artisan::call('route:clear');
        return redirect()->back()->with('success', 'Route cache cleared successfully!');
    })->name('route.clear');

