<?php

namespace App\Repositories\V1\FinancialEngineering\CashFlow\Operating;

use App\Models\Trader4\V1\FinancialEngineering\CashFlow\Operating;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class CashFlowOperatingRepository extends AbstractRepository implements ICashFlowOperatingRepository
{
    protected function instance(array $attributes = []): Model
    {
        return new Operating();
    }

    public function indexByUser(string $userId, string $cashFlowId, array $data): LengthAwarePaginator
    {
        return EloquentBuilder::to($this->model, $data)
            ->whereHas('cashFlow', function ($query) use ($userId, $cashFlowId) {
              $query->where('user_id', $userId)->where('id', $cashFlowId);
            })
            ->paginate();
    }

    public function singleByUser(string $userId, string $id)
    {
        return $this->model->query()
            ->whereRelation('cashFlow', 'user_id', $userId)
            ->where('id', $id)
            ->firstOrFail();
    }
}
