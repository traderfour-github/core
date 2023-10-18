<?php

namespace App\Http\Controllers\V1\Search;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Search\SearchListResource;
use App\Services\Search\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        private SearchService $searchService
    ) {
    }

    public function index(Request $request)
    {
        return $this->respond(SearchListResource::make($this->searchService->getSearch($request)));
    }
}
