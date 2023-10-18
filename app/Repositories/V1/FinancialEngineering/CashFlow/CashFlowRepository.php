<?php

namespace App\Repositories\V1\FinancialEngineering\CashFlow;

use App\Models\Trader4\V1\FinancialEngineering\CashFlow\CashFlow;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class CashFlowRepository extends AbstractRepository implements ICashFlowRepository
{
    protected function instance(array $attributes = []): Model
    {
        return new CashFlow();
    }

    public function indexByUser(string $userId, array $data): LengthAwarePaginator
    {
        return EloquentBuilder::to($this->model, $data)->where('user_id', $userId)->paginate();
    }

    public function singleByUser(string $userId, string $id)
    {
        return $this->model->query()->where('user_id', $userId)->where('id', $id)->firstOrFail();
    }
}
