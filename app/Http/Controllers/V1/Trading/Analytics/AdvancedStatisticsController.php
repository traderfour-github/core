<?php

namespace App\Http\Controllers\V1\Trading\Analytics;

use App\Http\Resources\V1\Trading\Analytics\AdvancedStatisticsResource;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\AverageLostTrade;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\AverageTradeLength;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\AverageWonTrade;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\ExpectancyTrade;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\MonetaryBestTrade;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\SummaryStatistics;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\TotalCountTrade;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\PercentLongWonTrade;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\ProfitabilityLost;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\ProfitabilityWon;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\ProfitFactor;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\SumCommission;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\SumLot;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\MonetaryWorstTrade;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\CountLongTrade;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\CountShortTrade;
use App\Jobs\V1\Trading\Analytics\AdvancedStatistics\PercentShortWonTrade;
use App\Http\Controllers\V1\Controller;

class AdvancedStatisticsController extends Controller
{
    public function index($trading_account)
    {
        $totalTrade       = TotalCountTrade::dispatchSync($trading_account);
        $profitabilityWon  = ProfitabilityWon::dispatchSync($trading_account);
        $profitabilityLost = ProfitabilityLost::dispatchSync($trading_account);
        $profitFactor      = ProfitFactor::dispatchSync($trading_account);
        $longWonTrade     = PercentLongWonTrade::dispatchSync($trading_account);
        $shortWonTrade    = PercentShortWonTrade::dispatchSync($trading_account);
        $bestTrade        = MonetaryBestTrade::dispatchSync($trading_account);
        $worstTrade       = MonetaryWorstTrade::dispatchSync($trading_account);
        $sumLot           = SumLot::dispatchSync($trading_account);
        $sumCommission    = SumCommission::dispatchSync($trading_account);
        $countLongTrade   = CountLongTrade::dispatchSync($trading_account);
        $countShortTrade  = CountShortTrade::dispatchSync($trading_account);
        $avgTradeLength   = AverageTradeLength::dispatchSync($trading_account);
        $expectancy       = ExpectancyTrade::dispatchSync($trading_account);
        $avgWonTrade      = AverageWonTrade::dispatchSync($trading_account);
        $avgLostTrade     = AverageLostTrade::dispatchSync($trading_account);
        $summaryStatistics = SummaryStatistics::dispatchSync($trading_account);



        return $this->respond(AdvancedStatisticsResource::make(
            $totalTrade ,
            $avgWonTrade,
            $avgLostTrade,
            $profitabilityWon ,
            $profitabilityLost,
            $profitFactor,
            $sumLot,
            $bestTrade,
            $worstTrade,
            $longWonTrade,
            $shortWonTrade,
            $sumCommission,
            $countLongTrade,
            $countShortTrade,
            $avgTradeLength,
            $expectancy,
            $summaryStatistics
        ));
    }
}
