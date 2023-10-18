<?php

namespace App\Services\Search\Traits;

trait StatusFilterTrait
{
    public function applyStatusFilter(array $values)
    {
        $this->query = $this->query->whereIn('status', $values);
    }
}
