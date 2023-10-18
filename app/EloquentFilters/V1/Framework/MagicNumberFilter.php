<?php

namespace App\EloquentFilters\V1\Framework;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class MagicNumberFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('magic_number', 'LIKE', '%'.$value.'%');
    }
}
