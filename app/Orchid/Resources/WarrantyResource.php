<?php

namespace App\Orchid\Resources;

use App\Orchid\Filters\WarrantyFilter;
use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Sight;
use Orchid\Crud\Filters\DefaultSorted;

class WarrantyResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Warranty::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [];
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

            TD::make('name', 'Tên khách hàng')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function ($model) {
                    return $model->name;
                }),

            TD::make('phone', 'Số điện thoại')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function ($model) {
                    return $model->phone;
                }),

            TD::make('created_at', 'Ngày đăng kí')
                ->sort()
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('warranty_code_id', 'Mã bảo hành')
                ->filter(TD::FILTER_TEXT)
                ->render(function ($model) {
                    return $model->warrantyCode->code;
                }),

            TD::make('warranty_type_id', 'Sản phẩm')
                ->render(function ($model) {
                    return $model->warrantyType->name;
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
            Sight::make('name', 'Tên khách hàng'),
            Sight::make('phone', 'Số điện thoại'),
            Sight::make('created_at', 'Ngày đăng kí')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
            Sight::make('ip_address', 'Địa chỉ IP'),
            Sight::make('warranty_code_id', 'Mã bảo hành')
                ->render(function ($model) {
                    return $model->warrantyCode->code;
                }),
            Sight::make('warranty_type_id', 'Sản phẩm')
                ->render(function ($model) {
                    return $model->warrantyType->name;
                }),
            Sight::make('store', 'Nơi mua'),
            Sight::make('duration', 'Thời hạn bảo hành')
                ->render(function ($model) {
                    return $model->warrantyType->duration . ' tháng';
                }),
            Sight::make('expired_at', 'Ngày hết hạn')
                ->render(function ($model) {
                    return (new \App\Helpers\AppHelper)->calculateExpiredAtFromWarranty($model->id);
                }),
        ];
    }

    /**
     * Get relationships that should be eager loaded when performing an index query.
     *
     * @return array
     */
    public function with(): array
    {
        return ['warrantyCode', 'warrantyType'];
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
     * Get the number of models to return per page
     *
     * @return int
     */
    public static function perPage(): int
    {
        return 20;
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return "Danh sách đăng kí bảo hành";
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */

    public static function singularLabel(): string
    {
        return "Đăng kí bảo hành";
    }
}
