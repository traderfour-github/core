<?php

namespace App\Http\Controllers\V1\Trading\Analytics;

use App\Jobs\V1\Trading\Analytics\Info\FetchTradingAccountWithBroker;
use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Trading\Analytics\InfoResource;
use App\Jobs\V1\Trading\Analytics\Info\CurrentBalance;
use App\Jobs\V1\Trading\Analytics\Info\CurrentEquity;
use App\Jobs\V1\Trading\Analytics\Info\Drawdown;
use App\Jobs\V1\Trading\Analytics\Info\FirstBalance;
use App\Jobs\V1\Trading\Analytics\Info\Gain;
use App\Jobs\V1\Trading\Analytics\Info\GainAbs;
use App\Jobs\V1\Trading\Analytics\Info\GainDaily;
use App\Jobs\V1\Trading\Analytics\Info\GainMonthly;
use App\Jobs\V1\Trading\Analytics\Info\Interest;
use App\Jobs\V1\Trading\Analytics\Info\MaxEquity;
use App\Jobs\V1\Trading\Analytics\Info\Profit;
use App\Jobs\V1\Trading\Analytics\Info\Withdrawals;

class InfoController extends Controller
{
    public function index($trading_account){

        $firstBalance      = FirstBalance::dispatchSync($trading_account);
        $currentBalance   = CurrentBalance::dispatchSync($trading_account);
        $currentEquity    = CurrentEquity::dispatchSync($trading_account);
        $maxEquity        = MaxEquity::dispatchSync($trading_account);
        $tradingAccount   = FetchTradingAccountWithBroker::dispatchSync($trading_account);
        $drawdown         = Drawdown::dispatchSync($trading_account);
        $profit            = Profit::dispatchSync($trading_account);
        $gain             = Gain::dispatchSync($trading_account);
        $gainDaily        = GainDaily::dispatchSync($trading_account);
        $gainMonthly      = GainMonthly::dispatchSync($trading_account);
        $gainAbs          = GainAbs::dispatchSync($trading_account);
        $interest         = Interest::dispatchSync($trading_account);
        $withdrawals      = Withdrawals::dispatchSync($trading_account);


        return $this->respond(InfoResource::make(
            $firstBalance ,
            $currentBalance,
            $drawdown,
            $currentEquity,
            $maxEquity,
            $tradingAccount,
            $profit,
            $gain,
            $gainDaily,
            $gainMonthly,
            $gainAbs,
            $interest,
            $withdrawals
        ));
    }
}
