<?php

namespace App\Jobs\V1\Trading\Analytics\AdvancedStatistics;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PercentShortWonTrade
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $tradingAccount)
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

            $countShort   = $data->whereNotNull('tp')->where('order','sell')->count() ;
            $totalTrade   = TotalCountTrade::dispatchSync($this->tradingAccount);

            return  round(($countShort/$totalTrade) * 100 , 0);

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
