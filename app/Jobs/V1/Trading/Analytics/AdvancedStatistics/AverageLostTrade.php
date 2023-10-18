<?php

namespace App\Jobs\V1\Trading\Analytics\AdvancedStatistics;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AverageLostTrade
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
            $avgLost       = $data->whereNull('tp')->avg('profit');

            return [
                "pips"   => "",
                "money"  => round($avgLost , 2)
            ];

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
