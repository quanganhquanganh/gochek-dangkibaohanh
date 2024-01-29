<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;

class WarrantyNhanhvnType extends Model
{
    use HasFactory, AsSource, Filterable, Attachable, Chartable;

    protected $fillable = [
        'id',
        'code',
        'name',
        'duration',
    ];
}
