<?php

namespace App\Jobs\V1\Trading\Analytics\Info;

use App\Repositories\V1\Trading\Analytics\AnalyticTradingAccountRepository;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchTradingAccountWithBroker
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
    public function handle(AnalyticTradingAccountRepository $analyticTradingAccountRepository)
    {
        try {

            return $analyticTradingAccountRepository->fetchTradingAccountWithBroker($this->tradingAccount);

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
