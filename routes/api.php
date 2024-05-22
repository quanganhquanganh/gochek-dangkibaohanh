<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarrantyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get all warranties
Route::get('/warranties', [WarrantyController::class, 'index']);

//Sync baohanh to sheet
Route::get('/sync-baohanh', [\App\Http\Controllers\BaoHanhController::class, 'syncBaohanhToSheet']);

//Sync old sheet to baohanh
Route::get('/sync-old-sheet', [\App\Http\Controllers\BaoHanhController::class, 'syncOldSheetToBaohanh']);

// Get store statistics
Route::get('/store-statistics', [WarrantyController::class, 'storeStatistics']);

// Get search volume
Route::get('/search-volume', [WarrantyController::class, 'searchVolume']);
