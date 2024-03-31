<?php

namespace App\Http\Controllers;

use App\Models\BaoHanh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BaoHanhController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_name' => 'required',
                'phone' => 'required',
                'email' => 'nullable | email',
                'product_name' => 'required | exists:products,name',
                'store_name' => 'required'
            ]);

            BaoHanh::create($request->only([
                'user_name',
                'phone',
                'email',
                'address',
                'product_name',
                'store_name'
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
            if ($baoHanhs->count() > 0) {
                return view('result', compact('baoHanhs'));
            }
            toastr()->error('Không tìm thấy thông tin bảo hành.');
            return back();
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau.');
            return back();
        }
    }
}
