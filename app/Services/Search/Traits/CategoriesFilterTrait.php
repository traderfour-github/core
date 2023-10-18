<?php

namespace App\Services\Search\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CategoriesFilterTrait
{
    public function applyCategoriesFilter(array $values)
    {
        $this->query = $this->query->whereHas('categories', function (Builder $builder) use ($values) {
            $builder->whereIn('id', $values);
        });
    }
}
