<?php

namespace App\Repositories\V1\FinancialEngineering\RiskManagement;

use App\Models\Trader4\V1\FinancialEngineering\RiskManagement;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class RiskManagementRepository extends AbstractRepository implements IRiskManagementRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator
    {
        return EloquentBuilder::to($this->model, $data)->where('user_id', $userId)->paginate();
    }

    public function singleByUser($user_id, $risk_management_id)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $risk_management_id)->firstOrFail();
    }

    public function updateByIdAndUserId($user_id, $risk_management_id, $data)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $risk_management_id)->update($data);
    }

    public function deleteByIdAndUserId($user_id, $risk_management_id)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $risk_management_id)->delete();
    }

    protected function instance(array $attributes = []): RiskManagement
    {
        return new RiskManagement();
    }
}
