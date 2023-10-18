<?php

namespace App\Jobs\V1\Trading\Analytics\Info;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
class Profit
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

            $currentEquity     = CurrentEquity::dispatchSync($this->tradingAccount);
            $currentBalance    = CurrentBalance::dispatchSync($this->tradingAccount);
            $firstBalance       = FirstBalance::dispatchSync($this->tradingAccount);
            $firstEquity        = FirstEquity::dispatchSync($this->tradingAccount);

            return round(
                ($currentEquity / $currentBalance) - ($firstEquity / $firstBalance),2
            );

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

