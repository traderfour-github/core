<?php

namespace App\EloquentFilters\V1\Terminal;

use Fouladgar\EloquentBuilder\Concerns\FiltersDatesTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class LastSeenFilter extends Filter
{
    use FiltersDatesTrait;
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $last_seen): Builder
    {
        return $this->filterDate($builder, $last_seen, 'last_seen');
    }
}
