<?php

namespace App\Jobs\V1\Trading\Analytics\AdvancedStatistics;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
use Illuminate\Bus\Queueable;

class AverageTradeLength
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
    public function handle(AnalyticTradeRepository $analyticTradeRepository)
    {
        try {

            $data = $analyticTradeRepository->prepareQueryTrades($this->tradingAccount);

            $hour = $data->project([
                '_id' => null ,
                'hourDifference' => [
                    '$abs' => [
                        '$avg' => [
                            '$dateDiff' => [
                                'startDate' => '$created_at',
                                'endDate'   => '$updated_at',
                                'unit'      => 'hour'
                            ]
                        ]
                    ]
                ]
            ])->get()->sum('hourDifference') ;

            $minute = $data->project([
                '_id' => null ,
                'minuteDifference' => [
                    '$abs' => [
                        '$avg' => [
                            '$dateDiff' => [
                                'startDate' => '$created_at',
                                'endDate'   => '$updated_at',
                                'unit'      => 'minute'
                            ]
                        ]
                    ]
                ]
            ])->get()->sum('minuteDifference') ;

            return $hour ."h" ." ". $minute."m";

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
