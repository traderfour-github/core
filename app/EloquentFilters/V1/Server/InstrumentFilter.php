<?php

namespace App\EloquentFilters\V1\Server;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class InstrumentFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('instruments', function($q) use ($value) {
            $q->where('name', 'LIKE', "%$value%");
        });
    }
}
