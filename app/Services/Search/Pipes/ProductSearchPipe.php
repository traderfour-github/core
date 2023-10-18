<?php

namespace App\Services\Search\Pipes;

use App\Models\Trader4\V1\Post;
use App\Services\Search\BaseFilter;
use App\Services\Search\Traits\CategoriesFilterTrait;
use App\Services\Search\Traits\DateFilterTrait;
use App\Services\Search\Traits\PlatformsFilterTrait;
use App\Services\Search\Traits\PriceFilterTrait;
use App\Services\Search\Traits\SearchFilterTrait;
use App\Services\Search\Traits\StatusFilterTrait;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class ProductSearchPipe extends BaseFilter
{
    use SearchFilterTrait;
    use StatusFilterTrait;
    use PriceFilterTrait;
    use DateFilterTrait;
    use CategoriesFilterTrait;
    use PlatformsFilterTrait;

    public Builder $query;

    public const SEARCHABLE_FIELD = 'title';

    public const FILTERABLE_PRICE_FIELDS = [];

    public const FILTERABLE_DATE_FIELDS = ['published_at'];

    public const FILTERABLE_RELATIONS = ['categories', 'platforms'];

    public function __construct(
    ) {
        $this->query = Post::query();
    }

    public function handle(SearchBasePipe $basePipe, Closure $next)
    {
        $this->applyFilters($basePipe);

        $basePipe->results['products'] = $this->getResult();

        return $next($basePipe);
    }
}
