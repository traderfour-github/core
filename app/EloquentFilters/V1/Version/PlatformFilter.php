<?php

namespace App\EloquentFilters\V1\Version;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class PlatformFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('platform', function($q) use ($value) {
            $q->where('title', 'LIKE', "%$value%");
        });
    }
}
