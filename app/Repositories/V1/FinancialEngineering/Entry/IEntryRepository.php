<?php

namespace App\Repositories\V1\FinancialEngineering\Entry;

use Illuminate\Pagination\LengthAwarePaginator;

interface IEntryRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator;

    public function singleByUser($user_id, $entry_id);

    public function updateByIdAndUserId($user_id, $entry_id, $data);

    public function deleteByIdAndUserId($user_id, $entry_id);
}
