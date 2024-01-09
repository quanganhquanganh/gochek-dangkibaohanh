<?php

use Illuminate\Support\Facades\Route;

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
    return view('home'); // Trả về view home.blade.php
})->name('home');

Route::get('/dangkybaohanhthanhcong', function () {
    return view('success'); // Trả về view success.blade.php
})->name('success');



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
