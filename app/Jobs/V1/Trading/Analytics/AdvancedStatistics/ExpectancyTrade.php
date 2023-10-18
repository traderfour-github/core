<?php

namespace App\Jobs\V1\Trading\Analytics\AdvancedStatistics;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExpectancyTrade
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private $tradingAccount)
    {
        //
    }

    /**
     * Execute the job.
     *
     */
    public function handle(AnalyticTradeRepository $analyticTradeRepository)
    {
        try {

            $data = $analyticTradeRepository->fetchTrades($this->tradingAccount);

            $avgProfit  = $data->whereNull('sl')->avg('profit');
            $avgLoss   = $data->whereNull('tp')->avg('profit');

            $profitabilityWon  = ProfitabilityWon::dispatchSync($this->tradingAccount);
            $profitabilityLost = ProfitabilityLost::dispatchSync($this->tradingAccount);

            $expectancyMonetary = round(
                ($avgProfit * $profitabilityWon) - ($avgLoss * $profitabilityLost) , 2
            );

            return [
                "pips"    => "",
                "money"   => $expectancyMonetary
            ];

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
