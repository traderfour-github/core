<?php

namespace App\EloquentFilters\V1\Broker;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class MoneyManagersFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        $key = array_key_first($value);

        return $builder->whereJsonContains('money_managers', [$key => $value[$key]]);
    }
}
