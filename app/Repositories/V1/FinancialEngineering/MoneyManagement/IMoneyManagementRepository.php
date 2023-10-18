<?php

namespace App\Repositories\V1\FinancialEngineering\MoneyManagement;

use Illuminate\Pagination\LengthAwarePaginator;

interface IMoneyManagementRepository
{
    public function all(string $userId, array $data): LengthAwarePaginator;

    public function findByUser(string $user_id, String $id);
}
