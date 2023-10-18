<?php

namespace App\EloquentFilters\V1\Terminal;

use Fouladgar\EloquentBuilder\Concerns\FiltersDatesTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class InstalledAtFilter extends Filter
{
    use FiltersDatesTrait;
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $installed_at): Builder
    {
        return $this->filterDate($builder, $installed_at, 'installed_at');
    }
}
