<?php

namespace App\Http\Controllers;

use App\Models\BaoHanh;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\WarrantyType;
class BaoHanhController extends Controller
{
    public function syncBaohanhToSheet(Request $request)
    {
        $lastUpdated = Carbon::parse($request->lastUpdated ?? '2021-01-01 00:00:00');
        $baoHanhs = BaoHanh::where('created_at', '>', $lastUpdated)->orderBy('created_at', 'desc')->get();
	    return response()->json([
	        //'oldLastUpdated' => $lastUpdated,
            'lastUpdated' => now()->format('Y-m-d H:i:s'),
            'baoHanhs' => $baoHanhs
        ]);
    }

    public function syncOldSheetToBaohanh(Request $request)
    {

        $warrantyTypes = WarrantyType::all();

        // Chuyển đổi danh sách các loại bảo hành thành mảng code => array
        $warrantyTypesArray = [];
        foreach ($warrantyTypes as $warrantyType) {
            $warrantyTypesArray[$warrantyType->code] = $warrantyType->name;
        }

        Log::info($warrantyTypesArray);

        SimpleExcelReader::create(storage_path('app/public/old_data.csv'))
            ->useDelimiter(',')
            //->useHeaders(['created_at','user_name', 'phone', 'code', 'shop'])
            ->getRows()
            ->each(function (array $rowProperties) use ($warrantyTypesArray) {
                //Log::info($rowProperties);
                $code = strtoupper($rowProperties['code']);
                Log::info($code);
                // Nếu 2 ký tự đầu tiên của mã bảo hành là chữ cái
                if ($this->isFirstTwoCharsAlphabetic($code)) {
                    // Lấy 2 ký tự đầu tiên của mã bảo hành
                    $warrantyTypeCode = substr($code,0,2);

                    // Nếu mã bảo hành có trong danh sách các loại bảo hành
                    if (array_key_exists($warrantyTypeCode, $warrantyTypesArray)) {
                        // Lấy tên loại bảo hành
                        $warrantyTypeName = $warrantyTypesArray[$warrantyTypeCode];

                        // Tạo bảo hành mới
                        $baoHanh = new BaoHanh();
                        $baoHanh->created_at = Carbon::parse($rowProperties['created_at']);
                        $baoHanh->user_name = $rowProperties['user_name'];
                        $baoHanh->phone = $this->normalizePhoneNumber($rowProperties['phone']);
                        $baoHanh->product_name = $warrantyTypeName;
                        $baoHanh->store_name = $this->checkStoreName($rowProperties['shop']);
                        $baoHanh->code = $code;
                        $baoHanh->save();
                    }
                }
            });
    }

    private function normalizePhoneNumber($phone)
    {
        // Kiểm tra nếu số điện thoại không bắt đầu bằng '0'
        if ($phone[0] !== '0') {
            // Thêm '0' vào đầu số điện thoại
            $phone = '0' . $phone;
        }
        return $phone;
    }

    private function capitalizeFirstTwoLetters($string)
    {
        if (strlen($string) < 2) {
            return strtoupper($string);
        }

        $firstTwoLetters = strtoupper(substr($string, 0, 2));
        $remainingString = substr($string, 2);

        return $firstTwoLetters . $remainingString;
    }

    private function checkStoreName($storeName)
    {
        $listAvailableStoreName = [
            "Shopee",
            "Tiktok Shop",
            "Lazada",
            "Facebook",
        ];
        $storeName = trim($storeName);
        if (in_array($storeName, $listAvailableStoreName)) {
            return $storeName;
        }
        return "Mua trực tiếp tại cửa hàng";
    }

    private function isFirstTwoCharsAlphabetic($string)
    {
        // Lấy 2 ký tự đầu tiên của chuỗi
        $firstTwoChars = substr($string, 0, 2);

        // Kiểm tra xem 2 ký tự đầu tiên có phải là chữ cái hay không
        return ctype_alpha($firstTwoChars);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_name' => 'required',
                'code' => 'nullable',
                'phone' => 'required',
                // 'email' => 'nullable | email',
                'product_name' => 'required | exists:products,name',
                'store_name' => 'required',
                'need_help' => 'required',
                // 'date_of_birth' => 'nullable',
                // 'device' => 'nullable',
                // 'purpose_of_use' => 'nullable',
            ]);

            BaoHanh::create($request->only([
                'user_name',
                'code',
                'phone',
                'email',
                'address',
                'product_name',
                'store_name',
                'need_help',
                'date_of_birth',
                'device',
                'purpose_of_use',
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
        // Điều chỉnh validate: Không yêu cầu cả hai trường đều có giá trị
        $request->validate([
            'phone' => 'nullable',
            'warranty_code' => 'nullable'
        ]);

        // Kiểm tra nếu cả hai từ khóa tìm kiếm đều null
        if (!$request->filled('phone') && !$request->filled('warranty_code')) {
           
        }
        // Nếu có ít nhất một trường tìm kiếm
        else {
            // Khởi tạo query cho BaoHanh
            $query = BaoHanh::query();

            // Thêm điều kiện tìm kiếm nếu tồn tại phone
            if ($request->filled('phone')) {
                $query->where('phone', $request->phone);
            }

            // Thêm điều kiện tìm kiếm nếu tồn tại warranty_code
            if ($request->filled('warranty_code')) {
                $query->where('code', trim($request->warranty_code));
            }

            // Thực hiện truy vấn và sắp xếp theo ngày tạo
            $baoHanhs = $query->orderBy('created_at', 'desc')->get();
        }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        } finally {
            $baoHanhs = $baoHanhs ?? [];
            Log::info($baoHanhs ? $baoHanhs->toArray() : []);
            return view('result', compact('baoHanhs'));
        }
    }
}
