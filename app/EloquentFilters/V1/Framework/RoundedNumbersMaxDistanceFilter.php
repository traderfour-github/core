<?php

namespace App\EloquentFilters\V1\Framework;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class RoundedNumbersMaxDistanceFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('rounded_numbers_max_distance', $value);
    }
}
