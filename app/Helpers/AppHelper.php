<?php
namespace App\Helpers;

use App\Models\Warranty;
use App\Models\WarrantyType;
use Carbon\Carbon;

class AppHelper
{
    public function calculateExpiredAtFromWarranty($warrantyId)
    {
        $warranty = Warranty::find($warrantyId);
        $warrantyType = $warranty->warrantyType;
        $warrantyCode = $warranty->warrantyCode->code;
        $manufacturingDate = Carbon::createFromFormat('my', substr($warrantyCode, 2, 4));
        $createdAt = $warranty->created_at;
        $duration = $warrantyType->duration;
        $maxExpiredAt = $manufacturingDate->copy()->addMonths(1)->startOfMonth()->addMonths($duration + 4);
        $expiredAt = $createdAt->addMonths($duration);
        if ($expiredAt->isFuture() && $expiredAt->lessThan($maxExpiredAt)) {
            return $expiredAt;
        }
        return $maxExpiredAt;
    }
}
