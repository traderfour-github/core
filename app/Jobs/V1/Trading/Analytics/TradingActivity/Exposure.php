<?php

namespace App\Jobs\V1\Trading\Analytics\TradingActivity;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Exception;

class Exposure
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

            $data = $analyticTradeRepository->prepareQueryMongodb();

           return '';

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
