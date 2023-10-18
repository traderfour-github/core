<?php

namespace App\EloquentFilters\V1\Framework;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class RoundedNumbersZeroDigitsFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('rounded_numbers_zero_digits', $value);
    }
}
