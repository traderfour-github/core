<?php

namespace App\Jobs\V1\Trading\Analytics\Trading;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CalculateDifferenceGain
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
            return [
                "this_today"        => '$current_today',
                "difference_today"  => '$previous_today',

                "this_week"         => '$current_week',
                "difference_week"   => '$current_week - $previous_week',

                "this_month"        => '$current_month',
                "difference_month"  => '$current_month - $previous_month',

                "this_year"         => '$current_year',
                "difference_year"   => '$current_year - $previous_year',
            ] ;

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
