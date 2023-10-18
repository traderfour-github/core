<?php

namespace App\Jobs\V1\Trading\Analytics\Info;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
class Drawdown
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

            $beforeLastBalance  = BeforeLastBalance::dispatchSync($this->tradingAccount);
            $currentBalance     = CurrentBalance::dispatchSync($this->tradingAccount);

            return round((
                ($beforeLastBalance - $currentBalance) / $beforeLastBalance)* 100 , 3
            );

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

