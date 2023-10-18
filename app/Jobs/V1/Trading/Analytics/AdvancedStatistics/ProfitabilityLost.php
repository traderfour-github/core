<?php

namespace App\Jobs\V1\Trading\Analytics\AdvancedStatistics;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
class ProfitabilityLost
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
    public function handle()
    {
        try {

            $lostTrade    = CountLostTrade::dispatchSync($this->tradingAccount);
            $totalTrade   = TotalCountTrade::dispatchSync($this->tradingAccount);

            return  round(($lostTrade/$totalTrade) * 100 , 2);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

