<?php

namespace App\Jobs\V1\Trading\Analytics\Info;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
class Gain
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

            $profit        = Profit::dispatchSync($this->tradingAccount);
            $firstBalance  = FirstBalance::dispatchSync($this->tradingAccount);

            return round(
                ($profit/$firstBalance) * 100,2
            );

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

