<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarrantyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = \App\Models\Product::orderBy('id', 'desc')->get();
    return view('home', compact('products')); // Trả về view home.blade.php
})->name('home');

Route::get('/search', function () {
    return view('search'); // Trả về view search.blade.php
})->name('search');

Route::post('/warranty-check', [WarrantyController::class, 'store'])->name('warranty-check');

Route::post('/warranty-search', [WarrantyController::class, 'search'])->name('warranty-search');

//baohanh create
Route::post('/baohanh', [\App\Http\Controllers\BaoHanhController::class, 'store'])->name('baohanh.store');
Route::post('/baohanh/search', [\App\Http\Controllers\BaoHanhController::class, 'search'])->name('baohanh.search');

Route::get('/error', function () {
    return view('register-error');
})->name('register-error');

Route::get('/oauth/login', function () {
    $apiVersion = '2.0';
    $appId = '74003';
    $returnLink = 'https://19c2-14-232-174-13.ngrok-free.app/nhanh/auth';

    $url = "https://nhanh.vn/oauth?version={$apiVersion}&appId={$appId}&returnLink={$returnLink}";

    return redirect($url);
});

Route::get('/nhanh/auth', function (Illuminate\Http\Request $request) {
    // Lấy access code từ query parameters
    $accessCode = $request->query('accessCode');

    // Xử lý access code ở đây

    dd($accessCode);
});
