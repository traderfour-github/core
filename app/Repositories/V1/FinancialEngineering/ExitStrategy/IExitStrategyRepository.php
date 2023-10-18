<?php

namespace App\Repositories\V1\FinancialEngineering\ExitStrategy;

use Illuminate\Pagination\LengthAwarePaginator;

interface IExitStrategyRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator;

    public function singleByUser($user_id, $exit_strategy_id);

    public function updateByIdAndUserId($user_id, $exit_strategy_id, $data);

    public function deleteByIdAndUserId($user_id, $exit_strategy_id);
}
