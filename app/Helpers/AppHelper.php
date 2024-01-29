<?php
namespace App\Helpers;

use App\Models\Warranty;
use App\Models\WarrantyType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AppHelper
{
    public static function calculateExpiredAtFromWarranty($warrantyId)
    {
        $warranty = Warranty::find($warrantyId);
        $warrantyType = $warranty->warrantyType;
        $warrantyCode = $warranty->warrantyCode->code;
        $manufacturingDate = Carbon::createFromFormat('my', substr($warrantyCode, 2, 4));
        $createdAt = $warranty->created_at;
        $duration = $warrantyType->duration;
        $maxExpiredAt = $manufacturingDate->copy()->addMonths(1)->startOfMonth()->addMonths($duration + 4);
        $expiredAt = $createdAt->copy()->addMonths($duration);
        if ($expiredAt->isFuture() && $expiredAt->lessThan($maxExpiredAt)) {
            return $expiredAt->format('d-m-Y');
        }
        return $maxExpiredAt->format('d-m-Y');
    }
}
