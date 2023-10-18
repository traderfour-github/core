<?php

namespace App\Http\Controllers\V1\Trading\Analytics;


use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Trading\Analytics\TradingActivityResource;
use App\Jobs\V1\Trading\Analytics\TradingActivity\Exposure;
use App\Jobs\V1\Trading\Analytics\TradingActivity\History;
use App\Jobs\V1\Trading\Analytics\TradingActivity\OpenOrders;
use App\Jobs\V1\Trading\Analytics\TradingActivity\OpenTrades;

class TradingActivityController extends Controller
{
    public function index($trading_account){

        $openTrades   = OpenTrades::dispatchSync($trading_account);
        $openOrders   = OpenOrders::dispatchSync($trading_account);
        $histories    = History::dispatchSync($trading_account);
        $exposure     = Exposure::dispatchSync($trading_account);


        return $this->respond(TradingActivityResource::make(
            $openTrades ,
            $openOrders,
            $histories,
            $exposure,
        ));
    }
}
