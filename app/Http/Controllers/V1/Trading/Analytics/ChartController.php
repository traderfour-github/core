<?php

namespace App\Http\Controllers\V1\Trading\Analytics;

use App\Http\Resources\V1\Trading\Analytics\ChartResource;
use App\Jobs\V1\Trading\Analytics\Chart\Balance;
use App\Http\Controllers\V1\Controller;
use App\Jobs\V1\Trading\Analytics\Chart\Drawdown;
use App\Jobs\V1\Trading\Analytics\Chart\Growth;
use App\Jobs\V1\Trading\Analytics\Chart\Profit;

class ChartController extends Controller
{
    public function index($trading_account){

        $balance   = Balance::dispatchSync($trading_account);
        $profit     = Profit::dispatchSync($trading_account);
        $growth    = Growth::dispatchSync($trading_account);
        $drawdown  = Drawdown::dispatchSync($trading_account);


        return $this->respond(ChartResource::make(
            $balance,
            $profit,
            $growth,
            $drawdown
        ));
    }
}
