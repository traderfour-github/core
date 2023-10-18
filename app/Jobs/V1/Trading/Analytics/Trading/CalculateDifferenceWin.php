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

class CalculateDifferenceWin
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
    public function handle(AnalyticTradeRepository $analyticTradeRepository)
    {
        try {

            $query = $analyticTradeRepository->prepareQueryTrades($this->tradingAccount);

            $current_today   = $query->where('created_at','>', now()->today())->count() ;
            $previous_today  = $query->where('created_at', '>=' , Carbon::now()->subDays(1))->count() ;

            $current_week    = $query->where('created_at', '>=' , Carbon::now()->startOfWeek())->count() ;
            $previous_week   = $query->where('created_at', '>' , Carbon::now()->subWeek()->startOfWeek())->count() ;

            $current_month   = $query->where('created_at', '>=' , Carbon::now()->startOfMonth())->count() ;
            $previous_month  = $query->where('created_at', '>' , Carbon::now()->subMonth()->startOfMonth())->count() ;

            $current_year    = $query->where('created_at', '>=' , Carbon::now()->startOfYear())->count() ;
            $previous_year   = $query->where('created_at', '>' , Carbon::now()->subYear()->startOfYear())->count() ;

            return [
                "this_today"        => $current_today,
                "difference_today"  => $previous_today,

                "this_week"         => $current_week,
                "difference_week"   => $current_week - $previous_week,

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
