<?php

namespace App\EloquentFilters\V1\Market;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class InstrumentFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('servers', function($q) use ($value) {
            $q->whereHas('instruments', function($qq) use ($value) {
                $qq->where('name', 'LIKE', "%$value%");
            });
        });
    }
}
