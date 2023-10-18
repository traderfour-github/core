<?php

namespace App\Repositories\V1\FinancialEngineering\Entry;

use App\Models\Trader4\V1\FinancialEngineering\TradingStrategyEntry;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EntryRepository extends AbstractRepository implements IEntryRepository
{
    public function indexByUser(string $userId, array $data): LengthAwarePaginator
    {
        return EloquentBuilder::to($this->model, $data)->where('user_id', $userId)->paginate();
    }

    public function singleByUser($user_id, $entry_id)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $entry_id)->firstOrFail();
    }

    public function updateByIdAndUserId($user_id, $entry_id, $data)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $entry_id)->update($data);
    }

    public function deleteByIdAndUserId($user_id, $entry_id)
    {
        return $this->model->query()->where('user_id', $user_id)->where('id', $entry_id)->delete();
    }

    protected function instance(array $attributes = []): Model
    {
        return new TradingStrategyEntry();
    }
}
