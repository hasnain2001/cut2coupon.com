<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\admin\StoresController;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
$stores = Stores::all();    
    return response()->json([
        'stores' => $stores
    ]);
});

Route::resource('store',StoresController::class);

Route::get('/store', [ApiController::class, 'getStores']);

Route::post('/store/add', [ApiController::class, 'add']);


