<?php

namespace App\EloquentFilters\V1\Terminal;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class MacAddressFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('mac_address', 'LIKE', '%'.$value.'%');
    }
}
