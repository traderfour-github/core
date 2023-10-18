<?php

namespace App\Jobs\V1\Trading\Analytics\Chart;

use App\Jobs\V1\Trading\Analytics\Info\FirstBalance;
use App\Repositories\V1\Trading\Analytics\AnalyticTradingHistoryRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class Growth
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

    private $query ;
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
    public function handle(AnalyticTradingHistoryRepository $repository)
    {
        try {

            $this->query = $repository->prepareQueryMongodb();

            $balance = $this->reportDaily('balance');
            $equity  = $this->reportDaily('equity');

            return [
                "growth_balance"   => $balance,
                "growth_equity"    => $equity
            ];

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }


    public function reportDaily($filed){
        $firstBalance  = FirstBalance::dispatchSync($this->tradingAccount);
        $growth_filed = 'growth_'.$filed;

        return $this->query->raw(function ($coll) use($filed , $firstBalance,$growth_filed){
            return $coll->aggregate([
                [
                    '$match' => [
                        'trading_account_id' =>  $this->tradingAccount
                    ],
                ],
                [
                    '$sort' => [
                        'created_at' => 1
                    ]
                ],
                [
                    '$set' => [
                        $growth_filed => [
                            '$round' => [
                                [
                                    '$multiply' => [
                                        [
                                            '$divide' => [['$toInt' => ['$'.$filed]] , $firstBalance]
                                        ],
                                        100
                                    ]
                                ],
                                2
                            ]
                        ]
                    ]
                ],
                [
                    '$project' => [
                        '_id' => 0 ,
                        $growth_filed => '$'.$growth_filed,
                        'day'     => ['$dayOfMonth' => '$created_at'],
                        'month'   => ['$month' => '$created_at'],
                        'year'    => ['$year' => '$created_at'],
                    ]
                ],
                [
                    '$addFields'=> [
                        'month'=> [
                            '$let'=> [
                                'vars'=>['monthsInString'=> [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec']],
                                'in'=> ['$arrayElemAt'=> ['$$monthsInString', '$month']]
                            ]
                        ]
                    ]
                ],
            ]);
        });
    }
}
