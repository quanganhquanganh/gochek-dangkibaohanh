<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WarrantyCode;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\WhereDate;
use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
class Warranty extends Model
{
    use HasFactory, AsSource, Filterable, Attachable, Chartable;

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

    protected $allowedSorts = [
        'name',
        'phone',
        'store',
        'warranty_code_id',
        'warranty_type_id',
        'ip_address',
        'created_at',
        'updated_at'
    ];

    protected $allowedFilters = [
        'name' => Like::class,
        'phone' => Like::class,
        'warrantyCode.code' => Like::class,
        'created_at' => WhereDate::class,
    ];
}
