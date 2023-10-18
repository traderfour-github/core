<?php

namespace App\EloquentFilters\V1\Version;

use Fouladgar\EloquentBuilder\Concerns\FiltersDatesTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class LastUpdateFilter extends Filter
{
    use FiltersDatesTrait;
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $last_update): Builder
    {
        return $this->filterDate($builder, $last_update, 'last_update');
    }
}
