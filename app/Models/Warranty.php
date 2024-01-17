<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WarrantyCode;

class Warranty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'store',
        'warranty_code_id',
        'warranty_type_id',
        'ip_address'
    ];

    public function warrantyCode()
    {
        return $this->hasOne(WarrantyCode::class, 'id', 'warranty_code_id');
    }

    public function warrantyType()
    {
        return $this->hasOne(WarrantyType::class, 'id', 'warranty_type_id');
    }
}
