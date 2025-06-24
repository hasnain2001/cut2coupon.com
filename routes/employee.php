<?php

use App\Http\Controllers\employee\BlogController;
use App\Http\Controllers\employee\CategoryController;
use App\Http\Controllers\employee\CouponController;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\employee\NetworkController;
use App\Http\Controllers\employee\SearchController;
use App\Http\Controllers\employee\StoresController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', 'role:employee'])->group(function () {


    Route::controller(EmployeeController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');

    });

    Route::controller(CategoryController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/categories', 'index')->name('category.index');
        Route::get('/category/create', 'create')->name('category.create');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{category}', 'edit')->name('category.edit');
        Route::put('/category/update/{category}', 'update')->name('category.update');
        Route::delete('/categories/{id}',  'destroy')->name('category.destroy');
        Route::get('/category/{id}', 'show')->name('category.show');
        });


        Route::controller(StoresController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/store', 'index')->name('store.index');
        Route::get('/store/create', 'create')->name('store.create');
        Route::post('/store/store', 'store')->name('store.store');
        Route::get('/store/edit/{stores}', 'edit')->name('store.edit');
        Route::put('/store/update/{stores}', 'update')->name('store.update');
        Route::delete('/store/{id}',  'destroy')->name('store.destroy');
        Route::get('/Store/{slug}', 'show')->name('store.show');
        Route::delete('/store/deleteSelected', 'deleteSelected')->name('store.deleteSelected');
        Route::get('/store/{slug}/store', 'store_detail')->name('store.details');

        });

        Route::controller(NetworkController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/network', 'index')->name('network.index');
        Route::get('/network/create', 'create')->name('network.create');
        Route::post('/network/store', 'store')->name('network.store');
        Route::get('/network/edit/{network}', 'edit')->name('network.edit');
        Route::put('/network/update/{network}', 'update')->name('network.update');
        Route::delete('/network/{network}',  'destroy')->name('network.destroy');

        });
        Route::controller(CouponController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/coupon', 'index')->name('coupon.index');
        Route::get('/coupon/create', 'create')->name('coupon.create');
        Route::post('/coupon/store', 'store')->name('coupon.store');
        Route::get('/coupon/edit/{coupon}', 'edit')->name('coupon.edit');
        Route::put('/coupon/update/{coupon}', 'update')->name('coupon.update');
        Route::delete('/coupon/delete/{coupon}',  'destroy')->name('coupon.destroy');
        Route::get('/coupon/{coupon}', 'show')->name('coupon.show');
        Route::post('coupon/update-order','updateOrder')->name('coupon.update-order');
        Route::delete('/coupon/deleteSelected', 'deleteSelected')->name('coupon.deleteSelected');

          });

    Route::controller(SearchController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/search/store', 'searchStores')->name('search.store');
        Route::get('/search/store/coupons', 'searchStoresCoupons')->name('search.store.coupons');
        Route::get('/search',  'search')->name('search');
        Route::get('/search_results',  'searchResults')->name('search_results');

        });

        Route::controller(BlogController::class)->prefix('employee')->name('employee.')->group(function () {
            Route::get('/blog', 'index')->name('blog.index');
            Route::get('/blog/create', 'create')->name('blog.create');
            Route::post('/blog/store', 'store')->name('blog.store');
            Route::get('/blog/edit/{blog}', 'edit')->name('blog.edit');
            Route::put('/blog/update/{blog}', 'update')->name('blog.update');
            Route::delete('/blog/delete/{blog}',  'destroy')->name('blog.destroy');
            Route::get('/blog/{blog:slug}', 'show')->name('blog.show');
            Route::post('/blog/deleteSelected', 'deleteSelected')->name('blog.deleteSelected');
            });

});
