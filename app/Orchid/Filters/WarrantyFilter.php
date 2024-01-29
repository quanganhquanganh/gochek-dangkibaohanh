<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;

class WarrantyFilter extends Filter
{

    public $parameters = ['phone', 'code'];

    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return '';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return [];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder
            ->whereHas('warrantyCode', function ($query) {
                $query->where('code', $this->request->get('code'));
            })
            ->where('phone', $this->request->get('phone'));
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
             Input::make('phone')
                ->type('text')
                ->title('Phone')
                ->placeholder('Phone')
                ->value($this->request->get('phone')),
            Input::make('code')
                ->type('text')
                ->title('Code')
                ->placeholder('Code')
                ->value($this->request->get('code')),
        ];
    }
}
