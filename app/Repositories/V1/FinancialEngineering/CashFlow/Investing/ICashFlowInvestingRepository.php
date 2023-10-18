<?php

namespace App\Repositories\V1\FinancialEngineering\CashFlow\Investing;

use Illuminate\Pagination\LengthAwarePaginator;

interface ICashFlowInvestingRepository
{
    public function indexByUser(string $userId, string $cashFlowId, array $data): LengthAwarePaginator;
    public function singleByUser(string $userId, string $id);
}
