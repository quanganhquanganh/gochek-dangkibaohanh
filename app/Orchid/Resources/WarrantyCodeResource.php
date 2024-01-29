<?php

namespace App\Orchid\Resources;

use Illuminate\Validation\Rule;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class WarrantyCodeResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\WarrantyCode::class;

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
                ->max(20)
                ->required()
                ->title('Mã bảo hành')
                ->placeholder('Nhập mã bảo hành')
                ->help('Mã bảo hành')
                ->popover('Mã bảo hành'),
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
            TD::make('id', 'ID'),

            TD::make('code', 'Mã bảo hành')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function ($model) {
                    return $model->code;
                }),

            TD::make('created_at', 'Ngày tạo')
                ->sort()
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Ngày cập nhật')
                ->sort()
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
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
            Sight::make('code', 'Mã bảo hành'),
            Sight::make('created_at', 'Ngày tạo')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
            Sight::make('updated_at', 'Ngày cập nhật')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
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
        return "Danh sách mã bảo hành";
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */

    public static function singularLabel(): string
    {
        return "Mã bảo hành";
    }

    /**
     * Get the validation rules that apply to save/update.
     *
     * @return array
     */

    public function rules(\Illuminate\Database\Eloquent\Model $model): array
    {
        return [
            'code' => [
                'required',
                'max:20',
                Rule::unique('warranty_codes', 'code')->ignore($model->id),
            ],
        ];
    }
}
