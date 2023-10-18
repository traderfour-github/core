<?php

namespace App\Repositories\V1\FinancialEngineering\TradingStrategy;

use Illuminate\Pagination\LengthAwarePaginator;

interface ITradingStrategyRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator;

    public function singleByUser($user_id, $trading_strategy_id);
}
