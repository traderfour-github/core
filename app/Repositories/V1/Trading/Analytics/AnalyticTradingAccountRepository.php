<?php

namespace App\Repositories\V1\Trading\Analytics;

use App\Models\Trader4\V1\Trading\Account;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class AnalyticTradingAccountRepository extends AbstractRepository
{

    public function instance(array $attributes = []): Model
    {
        return new Account();
    }


    public function fetchTradingAccountWithBroker($trading_account)
    {
        return $this->model->with('broker')->where([
            'id' => $trading_account
        ])->first();
    }
}
