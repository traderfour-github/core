<?php

namespace App\Jobs\V1\Trading\Analytics\AdvancedStatistics;

use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class SummaryStatistics
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

            $data = $analyticTradeRepository->prepareQueryMongodb();

            return $data->raw(function ($coll){
                return $coll->aggregate([
                    [
                        '$match' => [
                            'trading_account_id' =>  $this->tradingAccount
                        ],
                    ],
                   [
                       '$group' => [
                           '_id'   => '$symbol',
                           'count' => ['$sum' => 1],
                           'data'  => ['$push' => '$$ROOT'],
                       ]
                   ],
                    [
                        '$unwind'  => ['path' => '$_id' , 'preserveNullAndEmptyArrays' => false]
                    ],
                    [
                        '$project' => [
                            '_id' => 0 ,
                            'currency' => '$data.symbol',
                            'longs'    => [
                                'trades'   => [
                                    '$cond' => [
                                        'if' => ['$eq' => ['$data.order' , 'buy']],
                                        'then'  => ['$sum' => 1],
                                        'else'  => '23'
                                    ]
                                ],
                                'pips'     => '',
                                'profit'    => ''
                            ],
                            'shorts'    => [
                                'trades'   => '',
                                'pips'     => '',
                                'profit'    => ''
                            ],
                            'total' => [
                                'trades'   => '',
                                'pips'     => '',
                                'profit'    => '',
                                'won'      => '',
                                'lost'     => ''
                            ]
                        ]
                    ]
                ]);
            });

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
