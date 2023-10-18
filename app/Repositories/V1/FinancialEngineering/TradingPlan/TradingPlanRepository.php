<?php

namespace App\Repositories\V1\FinancialEngineering\TradingPlan;

use App\Models\Trader4\V1\FinancialEngineering\TradingPlan;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TradingPlanRepository extends AbstractRepository implements ITradingPlanRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator
    {
        return EloquentBuilder::to($this->model, $data)->where('user_id', $userId)->paginate();
    }

    public function singleByUser($user_id, $trading_plan_id)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $trading_plan_id)->firstOrFail();
    }

    public function updateByIdAndUserId($user_id, $trading_plan_id, $data): int
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $trading_plan_id)->update($data);
    }

    public function deleteByIdAndUserId($user_id, $trading_plan_id)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $trading_plan_id)->delete();
    }

    public function updateModel(Model $model, array $attributes): Model
    {
        $model->fill($attributes)->save();

        return $model;
    }

    protected function instance(array $attributes = []): TradingPlan
    {
        return new TradingPlan();
    }
}
