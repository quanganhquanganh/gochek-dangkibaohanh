<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\WhereDate;
use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;

class WarrantyType extends Model
{
    use HasFactory, AsSource, Filterable, Attachable, Chartable;

    protected $fillable = [
        'id',
        'code',
        'name',
        'duration',
    ];

    protected $allowedSorts = [
        'code',
        'name',
        'duration',
    ];

    protected $allowedFilters = [
        'code' => Like::class,
        'name' => Like::class,
        'duration ' => Like::class,
        'created_at' => WhereDate::class,
        'updated_at' => WhereDate::class,
    ];
}
