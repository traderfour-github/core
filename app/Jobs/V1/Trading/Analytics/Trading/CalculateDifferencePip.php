<?php

namespace App\Jobs\V1\Trading\Analytics\Trading;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Date;
use MongoDB\BSON\UTCDateTime;

class CalculateDifferencePip
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels , Batchable;

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
    public function handle(AnalyticTradeRepository $repository)
    {
        try {

            $current_today = $repository->getQueryByDate(
                0 , 86400000 , "lots" , $this->tradingAccount
            );

            $previous_today = $repository->getQueryByDate(
                86400000 , 86400000 * 2 , "lots" , $this->tradingAccount
            );

            $current_week = $repository->getQueryByDate(
                0 , 604800000 , "lots" , $this->tradingAccount
            );

            $previous_week = $repository->getQueryByDate(
                604800000 , 604800000 * 2 , "lots" , $this->tradingAccount
            );

            $current_month = $repository->getQueryByDate(
                0 , 2629743000 , "lots" , $this->tradingAccount
            );

            $previous_month = $repository->getQueryByDate(
                2629743000 , 2629743000 * 2 , "lots" , $this->tradingAccount
            );

            $current_year = $repository->getQueryByDate(
                0 , 31556926000 , "lots" , $this->tradingAccount
            );

            $previous_year = $repository->getQueryByDate(
                31556926000 , 31556926000*2 , "lots" , $this->tradingAccount
            );

            return [
                "this_today"        => '',
                "difference_today"  => '',

                "this_week"         => '',
                "difference_week"   => '',

                "this_month"        => '',
                "difference_month"  => '',

                "this_year"         => '',
                "difference_year"   => '',
            ] ;

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }

}
