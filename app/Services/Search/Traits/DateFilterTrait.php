<?php

namespace App\Services\Search\Traits;

trait DateFilterTrait
{
    public function applyDateFilter(string $field, array $values)
    {
        $this->query = $this->query->whereBetween($field, $values);
    }
}
