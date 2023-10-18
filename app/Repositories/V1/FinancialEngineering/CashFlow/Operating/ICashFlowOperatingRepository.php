<?php

namespace App\Repositories\V1\FinancialEngineering\CashFlow\Operating;

use Illuminate\Pagination\LengthAwarePaginator;

interface ICashFlowOperatingRepository
{
    public function indexByUser(string $userId, string $cashFlowId, array $data): LengthAwarePaginator;
    public function singleByUser(string $userId, string $id);
}
