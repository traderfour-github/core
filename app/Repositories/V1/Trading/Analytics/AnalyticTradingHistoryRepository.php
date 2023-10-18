<?php

namespace App\Repositories\V1\Trading\Analytics;

use App\Models\Trader4\V1\Trading\History;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class AnalyticTradingHistoryRepository extends AbstractRepository
{

    public function instance(array $attributes = []): Model
    {
        return new History();
    }


    public function fetchTradingHistory($trading_account)
    {
        return $this->model->whereRaw([
            'trading_account_id' => $trading_account
        ])->get();
    }


    public function prepareQueryMongodb() : Model
    {
        return $this->model ;
    }
}
