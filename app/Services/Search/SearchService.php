<?php

namespace App\Services\Search;

use App\Services\Search\Pipes\ProductSearchPipe;
use App\Services\Search\Pipes\SearchBasePipe;
use Illuminate\Http\Request;

class SearchService
{
    public const FILTERS = [
        'rating',
        'date',
        'status',
        'price',
        'platforms',
        'brokers',
        'categories',
    ];

    public function __construct(
    ) {
    }

    public function getSearch(Request $request)
    {
        return $this->search($request);
    }

    private function search(Request $request)
    {
        $pipes = [
            ProductSearchPipe::class,
        ];

        $filters = $request->only(self::FILTERS);
        $filters['search'] = $request->get('search');

        return pipeline()
            ->send(new SearchBasePipe($filters))
            ->through($pipes)
            ->then(function (SearchBasePipe $basePipe) {
                return $basePipe->results;
            });
    }
}
