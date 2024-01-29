<?php
namespace App\Http\Controllers;

use App\Http\Controllers\OrderController;
use App\Http\Requests\StoreWarrantyRequest;
use App\Models\WarrantyNhanhvnType;
use Illuminate\Http\Request;
use App\Models\Warranty;
use App\Models\WarrantyType;
use App\Models\WarrantyCode;
use App\Models\WarrantySearchVolume;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class WarrantyController extends Controller
{
    public function index(Request $request)
    {
        $lastUpdated = $request->lastUpdated ?? '2021-01-01 00:00:00';
        $warranties = Warranty::where('created_at', '>', $lastUpdated)
            ->with('warrantyCode')
            ->with('warrantyType')
            ->get();
        $warranties = $warranties->map(function ($warranty) {
            $warranty['warrantyType']['duration'] = $this->getDuration($warranty['warrantyCode']['code']);
            return $warranty;
        });
        return response()->json([
            'lastUpdated' => now(),
            'warranties' => $warranties,
        ]);
    }

    public function store(StoreWarrantyRequest $request)
    {
        $validatedData = $request->validated();

        $warrantyType = substr($validatedData['warranty_code'], 0, 2);
        $warrantyTypeId = WarrantyType::where('code', $warrantyType)->value('id');

        if (!$warrantyTypeId) {
            toastr()
                ->error('Kích hoạt bảo hành không thành công. Quý khách vui lòng kiểm tra lại thông tin.', 'Không hợp lệ');
            return back();
        }

        $warrantyCodeId = WarrantyCode::where('code', $validatedData['warranty_code'])->value('id');
        if (Warranty::where('warranty_code_id', $warrantyCodeId)->exists()) {
            toastr()->error('Sản phẩm này đã được kích hoạt bảo hành, để tra cứu thông tin bảo hành, truy cập vào mục “Tra cứu bảo hành”.', 'Không hợp lệ');
            return back();
        }

        Warranty::create([
            'warranty_code_id' => $warrantyCodeId,
            'warranty_type_id' => $warrantyTypeId,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'store' => $validatedData['store'],
            'ip_address' => $request->getClientIp(),
        ]);

        return view('success');
    }

    public function search(Request $request)
    {
        $phone = $request->phone;
        $warrantyCode = $request->warranty_code;
        $warranties = collect();

        if ($phone == null && $warrantyCode == null) {
            toastr()->error("Vui lòng điền thông tin để tra cứu bảo hành.", 'Không hợp lệ');
            return back();
        }

        $warranties = Warranty::where('phone', $phone)
            ->orWhereHas('warrantyCode', function ($query) use ($warrantyCode) {
                $query->where('code', $warrantyCode);
            })
            ->with('warrantyType')
            ->get();

        if ($warranties->isEmpty() && $phone != null) {
            $orderController = new OrderController();
            $orders = $orderController->getOrders($phone);

            if (isset($orders->data) && isset($orders->data->orders)) {
                $orders = json_decode(json_encode($orders->data->orders), true);
                usort($orders, function ($a, $b) {
                    return $a['deliveryDate'] <=> $b['deliveryDate'];
                });

                foreach ($orders as $order) {
                    foreach ($order['products'] as $item) {
                        $barcode = $item['productBarcode'];
                        $duration = $this->getDurationOfWarrantyNhanhvnType($barcode);
                        if ($duration){
                            $warranties->push([
                                'code' => $item['productCode'],
                                'warrantyType' => [
                                    'duration' => $duration,
                                    'name' => $item['productName'],
                                ],
                                'warrantyCode' => [
                                    'code' => $barcode,
                                ],
                                'created_at' => $order['deliveryDate'],
                                'delivery' => true,
                            ]);
                        }
                    }
                }
            }
        }

        if ($warranties->isEmpty()) {
            toastr()->error("Không tìm thấy thông tin sản phẩm.\nQuý khách vui lòng kiểm tra lại thông tin", 'Không hợp lệ');
            return back();
        }

        foreach ($warranties as $warranty) {
            $maxDuration = $warranty['warrantyType']['duration'];
            $duration = $maxDuration;
            if (isset($warranty['warrantyCode']['code'])) {
                try {
                    $duration = $this->getDuration($warranty['warrantyCode']['code']);
                } catch (\Exception $e) {
                    $duration = $maxDuration;
                }
            }
            $warranty['warrantyType']['duration'] = min($duration, $maxDuration);
        }

        $this->incrementVolume();

        return view('result', compact('warranties'));
    }

    public function searchVolume(Request $request)
    {
        $lastUpdated = $request->lastUpdated ?? '2021-01-01 00:00:00';
        $searchVolumes = WarrantySearchVolume::where('updated_at', '>', $lastUpdated)->get();
        $searchVolumes = $searchVolumes->map(function ($searchVolume) {
            return [
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', $searchVolume->date)
                    ->setTimezone('Asia/Ho_Chi_Minh'),
                'volume' => $searchVolume->volume,
            ];
        });
        return response()->json([
            'lastUpdated' => now(),
            'searchVolumes' => $searchVolumes,
        ]);
    }

    public function storeStatistics(Request $request)
    {
        $lastUpdated = $request->lastUpdated ?? '2021-01-01 00:00:00';
        $warranties = Warranty::where('created_at', '>', $lastUpdated)->get();
        // Group the results by each day
        $warranties = $warranties->groupBy(function ($warranty) {
            return $warranty->created_at->format('d/m');
        });
        // Count all the store types for each day
        $warranties = $warranties->map(function ($warranties) {
            return $warranties->groupBy('store')->map(function ($warranties) {
                return $warranties->count();
            })->mapWithKeys(function ($value, $key) {
                // If the key is empty, replace it with 'Khác'
                return [$key ?: 'Khác' => $value];
            });
        });

        return response()->json([
            'lastUpdated' => now(),
            'statistics' => $warranties,
        ]);
    }

    private function incrementVolume()
    {
        $now = Carbon::now();
        $now->minute = 0;
        $now->second = 0;
        $now->hour = $now->hour - $now->hour % 6;
        // Increment the volume of the current hour
        $searchVolume = WarrantySearchVolume::where('date', $now)->first();
        if ($searchVolume) {
            $searchVolume->increment('volume');
        } else {
            WarrantySearchVolume::create([
                'date' => $now,
                'volume' => 1,
            ]);
        }
    }

    private function getDuration(string $warrantyCode): int
    {
        $warrantyType = substr($warrantyCode, 0, 2);
        $manifacturingDate = Carbon::createFromFormat('my', substr($warrantyCode, 2, 4));
        $duration = WarrantyType::where('code', $warrantyType)->value('duration');

        if ($manifacturingDate->addMonths($duration + 4)->isFuture()) {
            return $duration;
        }

        return 0;
    }

//    private function findWarrantyType(string $input): ?WarrantyType
//    {
//        $input = strtolower($input); // Convert the input to lowercase
//        $words = explode(' ', $input); // Split the input into words
//        $warrantyTypes = []; // Array of warranty types
//
//        foreach ($words as $word) {
//            $warrantyType = WarrantyType::whereJsonContains('keywords', $word)->first();
//            // Increment the count of the warranty type if it exists
//            if ($warrantyType) {
//                if (array_key_exists($warrantyType->id, $warrantyTypes)) {
//                    $warrantyTypes[$warrantyType->id]['count']++;
//                } else {
//                    $warrantyTypes[$warrantyType->id] = [
//                        'warrantyType' => $warrantyType,
//                        'count' => 1,
//                    ];
//                }
//            }
//        }
//
//        // Sort the warranty types by count
//        usort($warrantyTypes, function ($a, $b) {
//            return $b['count'] <=> $a['count'];
//        });
//
//        // Return the warranty type with the highest count
//        return $warrantyTypes[0]['warrantyType'] ?? null;
//    }

    private function getDurationOfWarrantyNhanhvnType(string $warrantyCode): ?int
    {
        return WarrantyNhanhvnType::where('code', $warrantyCode)->first()->duration ?? null;
    }
}
?>
