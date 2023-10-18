<?php

namespace App\Services\Search\Pipes;

class SearchBasePipe
{
    public array $results = [];

    public function __construct(
        public array $filters = []
    ) {
    }
}
