<?php

namespace App\EloquentFilters\V1\Account;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class SecretReadOnlyFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('secret_read_only', 'LIKE', '%'.$value.'%');
    }
}
