<?php

namespace App\Orchid\Resources;

use Illuminate\Validation\Rule;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class WarrantyNhanhvnTypeResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\WarrantyNhanhvnType::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('code')
                ->type('text')
                ->max(50)
                ->required()
                ->title('Loại mã bảo hành'),

            Input::make('name')
                ->type('text')
                ->max(255)
                ->required()
                ->title('Tên loại sản phẩm'),

            Input::make('duration')
                ->type('number')
                ->max(50)
                ->required()
                ->title('Thời hạn bảo hành'),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),

            TD::make('code', 'Loại mã bảo hành')
                ->filter(TD::FILTER_TEXT)
                ->align(TD::ALIGN_CENTER)
                ->render(function ($model) {
                    return $model->code;
                }),

            TD::make('name', 'Tên loại sản phẩm')
                ->filter(TD::FILTER_TEXT)
                ->render(function ($model) {
                    return $model->name;
                }),

            TD::make('duration', 'Thời hạn bảo hành')
                ->filter(TD::FILTER_TEXT)
                ->align(TD::ALIGN_CENTER)
                ->render(function ($model) {
                    return $model->duration . ' tháng';
                }),

            TD::make('updated_at', 'Ngày cập nhật')
                ->filter(TD::FILTER_TEXT)
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),

            TD::make('created_at', 'Ngày tạo')
                ->filter(TD::FILTER_TEXT)
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id', 'ID'),
            Sight::make('code', 'Loại mã bảo hành'),
            Sight::make('name', 'Tên loại sản phẩm'),
            Sight::make('duration', 'Thời hạn bảo hành')
                ->render(function ($model) {
                    return $model->duration . ' tháng';
                }),
            Sight::make('updated_at', 'Ngày cập nhật')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
            Sight::make('created_at', 'Ngày tạo')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            new DefaultSorted('created_at', 'desc'),
        ];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return "Loại bảo hành theo Nhanh.vn";
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */

    public static function singularLabel(): string
    {
        return "Loại bảo hành theo Nhanh.vn";
    }

    public function rules(\Illuminate\Database\Eloquent\Model $model): array
    {
        return [
            'code' => [
                'required',
                'max:50',
                Rule::unique('warranty_nhanhvn_types', 'code')->ignore($model->id),
            ],
        ];
    }
}
