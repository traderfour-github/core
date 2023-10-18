<?php

namespace App\Repositories\V1\FinancialEngineering\TradingPlan;

use Illuminate\Pagination\LengthAwarePaginator;

interface ITradingPlanRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator;

    public function singleByUser($user_id, $trading_plan_id);

    public function updateByIdAndUserId($user_id, $trading_plan_id, $data);

    public function deleteByIdAndUserId($user_id, $trading_plan_id);
}
