<?php

namespace App\Jobs\V1\Trading\Analytics\Chart;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class Profit
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
    public function handle(AnalyticTradeRepository $repository)
    {
        try {

            $this->query = $repository->prepareQueryMongodb();

            $sequence_profit = $this->reportDaily('profit');

            return [
                "sequence"     => $sequence_profit,
            ];

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }


    public function reportDaily($filed){
        return $this->query->raw(function ($coll) use($filed){
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
                    '$project' => [
                        '_id' => 0 ,
                        $filed     => '$'.$filed,
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
                ]
            ]);
        });
    }
}
