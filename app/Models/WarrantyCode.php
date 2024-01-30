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

class WarrantyCode extends Model
{
    use HasFactory, AsSource, Filterable, Attachable, Chartable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code'];

    /**
     * Name of columns to which http sorting can be applied
     *
     * @var array
     */
    protected $allowedSorts = [
        'code',
        'created_at',
        'updated_at'
    ];

    /**
     * Name of columns to which http filtering can be applied
     *
     * @var array
     */

    protected $allowedFilters = [
        'code' => Like::class,
        'created_at' => WhereDate::class,
        'updated_at' => WhereDate::class
    ];
}
