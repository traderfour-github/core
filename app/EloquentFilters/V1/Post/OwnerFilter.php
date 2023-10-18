<?php

namespace App\EloquentFilters\V1\Post;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class OwnerFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('user', function ($query) use ($value) {
            $query->where('username', 'LIKE', "%.$value.%");
        } );
    }
}
