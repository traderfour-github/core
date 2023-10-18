<?php

namespace App\EloquentFilters\V1\Framework;

use Fouladgar\EloquentBuilder\Concerns\FiltersDatesTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class RiskFreeSwapCalculationFilter extends Filter
{
    use FiltersDatesTrait;
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $published_at): Builder
    {
        return $this->filterDate($builder, $published_at, 'risk_free_swap_calculate');
    }
}
