<?php

namespace App\Jobs\V1\Trading\Analytics\Info;

use App\Repositories\V1\Trading\Analytics\AnalyticTradingHistoryRepository;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BeforeLastBalance
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

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
    public function handle(AnalyticTradingHistoryRepository $analyticTradingHistoryRepository,)
    {
        try {

            $data = $analyticTradingHistoryRepository->fetchTradingHistory($this->tradingAccount);

            return $data->sortByDesc('created_at')->skip(1)->take(1)->first()->balance ;

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
