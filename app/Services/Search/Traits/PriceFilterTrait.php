<?php

namespace App\Services\Search\Traits;

use Illuminate\Database\Eloquent\Builder;

trait PriceFilterTrait
{
    public function applyPriceFilter(string $field, array $values)
    {
        $this->query = $this->query->where(function (Builder $builder) use ($field, $values) {
            foreach ($values as $range) {
                if (is_null($range[0]) && is_null($range[1])) {
                    $builder->orWhereNull($field);

                    continue;
                }

                $builder->orWhereBetween($field, $range);
            }
        });
    }
}
