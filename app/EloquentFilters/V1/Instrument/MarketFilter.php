<?php

namespace App\EloquentFilters\V1\Instrument;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class MarketFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('server', function($q) use ($value) {
            $q->whereHas('market', function ($qq) use ($value) {
                $qq->where('name', 'LIKE', "%$value%");
            });
        });
    }
}
