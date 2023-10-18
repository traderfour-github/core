<?php

namespace App\Repositories\V1\FinancialEngineering\MoneyManagement;

use App\Models\Trader4\V1\FinancialEngineering\MoneyManagement;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class MoneyManagementRepository extends AbstractRepository implements IMoneyManagementRepository
{
    protected function instance(array $attributes = []): Model
    {
        return new MoneyManagement();
    }

    public function all(string $userId, array $data): LengthAwarePaginator
    {
        return EloquentBuilder::to($this->model, $data)->where('user_id', $userId)->paginate();
    }

    public function findByUser($user_id, $uuid)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $uuid)->firstOrFail();
    }
}
