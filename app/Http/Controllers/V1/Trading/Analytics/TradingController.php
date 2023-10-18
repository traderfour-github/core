<?php

namespace App\Http\Controllers\V1\Trading\Analytics;


use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Trading\Analytics\TradingResource;
use App\Jobs\V1\Trading\Analytics\Trading\CalculateDifferenceGain;
use App\Jobs\V1\Trading\Analytics\Trading\CalculateDifferenceLot;
use App\Jobs\V1\Trading\Analytics\Trading\CalculateDifferencePip;
use App\Jobs\V1\Trading\Analytics\Trading\CalculateDifferenceProfit;
use App\Jobs\V1\Trading\Analytics\Trading\CalculateDifferenceTrade;
use App\Jobs\V1\Trading\Analytics\Trading\CalculateDifferenceWin;

class TradingController extends Controller
{
    public function index($trading_account){

        $differenceTrade      = CalculateDifferenceTrade::dispatchSync($trading_account);
        $differenceLot        = CalculateDifferenceLot::dispatchSync($trading_account);
        $differenceProfit      = CalculateDifferenceProfit::dispatchSync($trading_account);
        $differenceGain       = CalculateDifferenceGain::dispatchSync($trading_account);
        $differenceWin        = CalculateDifferenceWin::dispatchSync($trading_account);
        $differencePip        = CalculateDifferencePip::dispatchSync($trading_account);


        return $this->respond(TradingResource::make(
            $differenceTrade ,
            $differenceLot,
            $differenceProfit,
            $differenceGain,
            $differenceWin,
            $differencePip
        ));
    }
}
