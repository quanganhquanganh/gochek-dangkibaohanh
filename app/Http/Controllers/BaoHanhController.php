<?php

namespace App\Http\Controllers;

use App\Models\BaoHanh;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BaoHanhController extends Controller
{
    //

    public function syncBaohanhToSheet(Request $request)
    {
        $lastUpdated = Carbon::parse($request->lastUpdated ?? '2021-01-01 00:00:00');
        $baoHanhs = BaoHanh::where('created_at', '>', $lastUpdated)->orderBy('created_at', 'desc')->get();
//        Log::info('Now: ' . now() . ' Last Updated: ' . $lastUpdated);
//        Log::info('Found ' . $baoHanhs->count() . ' new baohanh');
//        Log::info($baoHanhs);
        return response()->json([
            'lastUpdated' => now(),
            'baoHanhs' => $baoHanhs
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_name' => 'required',
                'phone' => 'required',
                'email' => 'nullable | email',
                'product_name' => 'required | exists:products,name',
                'store_name' => 'required',
                'need_help' => 'required'
            ]);

            BaoHanh::create($request->only([
                'user_name',
                'phone',
                'email',
                'address',
                'product_name',
                'store_name',
                'need_help'
            ]));
            return view('success');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            return view('register-error');
        }
    }

    public function search(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required'
            ]);

            $baoHanhs = BaoHanh::where('phone', $request->phone)->orderBy('created_at', 'desc')->get();
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        finally {
            $baoHanhs = $baoHanhs ?? [];
            return view('result', compact('baoHanhs'));
        }
    }
}
