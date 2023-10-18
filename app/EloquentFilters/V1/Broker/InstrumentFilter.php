<?php

namespace App\EloquentFilters\V1\Broker;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class InstrumentFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('platforms', function($q) use ($value) {
            $q->whereHas('instruments', function($qq) use ($value) {
                $qq->where('title', 'LIKE', "%$value%")
            });
        });
    }
}
