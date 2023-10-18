<?php

namespace App\EloquentFilters\V1\Platform;

use Fouladgar\EloquentBuilder\Concerns\SortableTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class SortFilter extends Filter
{
    use SortableTrait;

    protected array $sortable = [
        'title',
        'status',
    ];

    public function apply(Builder $builder, mixed $value): Builder
    {
        return $this->applySort($builder, $value);
    }
}
