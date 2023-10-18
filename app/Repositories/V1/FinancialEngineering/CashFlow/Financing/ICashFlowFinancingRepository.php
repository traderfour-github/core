<?php

namespace App\Repositories\V1\FinancialEngineering\CashFlow\Financing;

use Illuminate\Pagination\LengthAwarePaginator;

interface ICashFlowFinancingRepository
{
    public function indexByUser(string $userId, string $cashFlowId, array $data): LengthAwarePaginator;
    public function singleByUser(string $userId, string $id);
}
