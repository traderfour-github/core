<?php

namespace App\Jobs\V1\Trading\Analytics\Info;

use App\Repositories\V1\Trading\Analytics\AnalyticTradingHistoryRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CurrentBalance
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
    public function handle(AnalyticTradingHistoryRepository $analyticTradingHistoryRepository,)
    {
        try {

            $data = $analyticTradingHistoryRepository->fetchTradingHistory($this->tradingAccount);

            return round(
                $data->sortByDesc('created_at')->first()->balance , 2
            ) ;

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
