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

class CalculateDifferenceTrade
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
                0 , 86400000 , "count" , $this->tradingAccount
            );

            $previous_today = $repository->getQueryByDate(
                86400000 , 86400000 * 2 , "count" , $this->tradingAccount
            );

            $current_week = $repository->getQueryByDate(
                0 , 604800000 , "count" , $this->tradingAccount
            );

            $previous_week = $repository->getQueryByDate(
                604800000 , 604800000 * 2 , "count" , $this->tradingAccount
            );

            $current_month = $repository->getQueryByDate(
                0 , 2629743000 , "count" , $this->tradingAccount
            );

            $previous_month = $repository->getQueryByDate(
                2629743000 , 2629743000 * 2 , "count" , $this->tradingAccount
            );

            $current_year = $repository->getQueryByDate(
                0 , 31556926000 , "count" , $this->tradingAccount
            );

            $previous_year = $repository->getQueryByDate(
                31556926000 , 31556926000*2 , "count" , $this->tradingAccount
            );

            return [
                "this_today"        => $current_today,
                "difference_today"  => $current_today - $previous_today,

                "this_week"         => $current_week,
                "difference_week"   => $current_week - $previous_week ,

                "this_month"        => $current_month,
                "difference_month"  => $current_month - $previous_month,

                "this_year"         => $current_year,
                "difference_year"   => $current_year - $previous_year,
            ] ;

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
