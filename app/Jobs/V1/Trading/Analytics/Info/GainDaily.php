<?php

namespace App\Jobs\V1\Trading\Analytics\Info;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GainDaily
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

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

            $data = $analyticTradeRepository->fetchTrades($this->tradingAccount);

            $startDate = Carbon::parse($data->sortBy('created_at')->first()->created_at) ;
            $endDate   = Carbon::parse($data->sortByDesc('created_at')->first()->created_at );
            $totalDays = $startDate->diffInDays($endDate) ;
            $gain      = Gain::dispatchSync($this->tradingAccount);

            return round(
                ($gain/$totalDays) * 100 , 2
            );

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
