<?php

namespace App\Services\Search\Traits;

use Illuminate\Database\Eloquent\Builder;

trait PlatformsFilterTrait
{
    public function applyPlatformsFilter(array $values)
    {
        $this->query = $this->query->whereHas('platforms', function (Builder $builder) use ($values) {
            $builder->whereIn('id', $values);
        });
    }
}
