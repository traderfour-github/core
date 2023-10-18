<?php

namespace App\Repositories\V1\FinancialEngineering\TradingStrategy;

use App\Models\Trader4\V1\FinancialEngineering\TradingStrategy;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class TradingStrategyRepository extends AbstractRepository implements ITradingStrategyRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator
    {
        return EloquentBuilder::to($this->model, $data)->where('user_id', $userId)->paginate();
    }

    public function singleByUser($user_id, $trading_strategy_id)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $trading_strategy_id)->firstOrFail();
    }

    protected function instance(array $attributes = []): TradingStrategy
    {
        return new TradingStrategy();
    }
}
