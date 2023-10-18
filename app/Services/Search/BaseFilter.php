<?php

namespace App\Services\Search;

use App\Services\Search\Pipes\SearchBasePipe;

abstract class BaseFilter
{
    public function applyFilters(SearchBasePipe $basePipe)
    {
        if (!empty($basePipe->filters['search'])) {
            $this->applySearchFilter($this::SEARCHABLE_FIELD, $basePipe->filters['search']);
        }

        if (!empty($basePipe->filters['status'])) {
            $this->applyStatusFilter($basePipe->filters['status']);
        }

        if (!empty($basePipe->filters['price'])) {
            foreach ($this::FILTERABLE_PRICE_FIELDS as $field) {
                $this->applyPriceFilter($field, $basePipe->filters['price']);
            }
        }

        if (!empty($basePipe->filters['date'])) {
            foreach ($this::FILTERABLE_DATE_FIELDS as $field) {
                $this->applyDateFilter($field, $basePipe->filters['date']);
            }
        }

        foreach ($this::FILTERABLE_RELATIONS as $relation) {
            if (array_key_exists($relation, $basePipe->filters)) {
                $method = 'apply'.ucwords($relation).'Filter';

                $this->{$method}($basePipe->filters[$relation]);
            }
        }
    }

    public function getResult()
    {
        return $this->query->get();
    }
}
