<?php

namespace App\EloquentFilters\V1\Investing;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class SourceTypeFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
         return $builder->where('source_type', $value);
    }
}
