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

class CalculateDifferenceProfit
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
                0 , 86400000 , "profit" , $this->tradingAccount
            );

            $previous_today = $repository->getQueryByDate(
                86400000 , 86400000 * 2 , "profit" , $this->tradingAccount
            );

            $current_week = $repository->getQueryByDate(
                0 , 604800000 , "profit" , $this->tradingAccount
            );

            $previous_week = $repository->getQueryByDate(
                604800000 , 604800000 * 2 , "profit" , $this->tradingAccount
            );

            $current_month = $repository->getQueryByDate(
                0 , 2629743000 , "profit" , $this->tradingAccount
            );

            $previous_month = $repository->getQueryByDate(
                2629743000 , 2629743000 * 2 , "profit" , $this->tradingAccount
            );

            $current_year = $repository->getQueryByDate(
                0 , 31556926000 , "profit" , $this->tradingAccount
            );

            $previous_year = $repository->getQueryByDate(
                31556926000 , 31556926000*2 , "profit" , $this->tradingAccount
            );

            return [
                "this_today"        => round($current_today , 2),
                "difference_today"  => round($current_today - $previous_today , 2),

                "this_week"         => round($current_week , 2),
                "difference_week"   => round($current_week - $previous_week , 2) ,

                "this_month"        => round($current_month , 2),
                "difference_month"  => round($current_month - $previous_month , 2),

                "this_year"         => round($current_year , 2),
                "difference_year"   => round($current_year - $previous_year , 2),
            ] ;

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
