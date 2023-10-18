<?php

namespace App\Repositories\V1\FinancialEngineering\RiskManagement;

use Illuminate\Pagination\LengthAwarePaginator;

interface IRiskManagementRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator;

    public function singleByUser($user_id, $risk_management_id);

    public function updateByIdAndUserId($user_id, $risk_management_id, $data);

    public function deleteByIdAndUserId($user_id, $risk_management_id);
}
