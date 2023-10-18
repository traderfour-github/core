<?php

namespace App\Jobs\V1\Trading\Analytics\Info;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
class GainAbs
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

            return 'abs.gain';

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

