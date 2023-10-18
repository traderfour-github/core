<?php

namespace App\Repositories\V1\FinancialEngineering\ExitStrategy;

use App\Models\Trader4\V1\FinancialEngineering\TradingStrategyExit;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class ExitStrategyRepository extends AbstractRepository implements IExitStrategyRepository
{

    public function indexByUser(string $userId, array $data): LengthAwarePaginator
    {
        return EloquentBuilder::to($this->model, $data)->where('user_id', $userId)->paginate();
    }

    public function singleByUser($user_id, $exit_strategy_id)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $exit_strategy_id)->firstOrFail();
    }

    public function updateByIdAndUserId($user_id, $exit_strategy_id, $data): int
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $exit_strategy_id)->update($data);
    }

    public function deleteByIdAndUserId($user_id, $exit_strategy_id)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $exit_strategy_id)->delete();
    }

    protected function instance(array $attributes = []): TradingStrategyExit
    {
        return new TradingStrategyExit();
    }
}
