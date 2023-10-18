<?php

namespace App\Repositories\V1\FinancialEngineering\CashFlow;

use Illuminate\Pagination\LengthAwarePaginator;

interface ICashFlowRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator;
    public function singleByUser(string $userId, string $id);
}
