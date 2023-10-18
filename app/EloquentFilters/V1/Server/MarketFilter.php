<?php

namespace App\EloquentFilters\V1\Server;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class MarketFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('market', function ($q) use ($value) {
            $q->where('name', 'LIKE', "%$value%");
        });
    }
}
