<?php

namespace App\Services\Search\Traits;

trait SearchFilterTrait
{
    public function applySearchFilter(string $field, string $value)
    {
        $this->query = $this->query->where($field, 'like', '%'.$value.'%');
    }
}
