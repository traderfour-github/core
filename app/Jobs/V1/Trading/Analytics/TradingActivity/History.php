<?php

namespace App\Jobs\V1\Trading\Analytics\TradingActivity;

use App\Jobs\V1\Trading\Analytics\Info\FirstBalance;
use App\Repositories\V1\Trading\Analytics\AnalyticTradeRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class History
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
            $firstBalance  = FirstBalance::dispatchSync($this->tradingAccount);

            return $data->raw(function ($coll) use($analyticTradeRepository , $firstBalance){
                return $coll->aggregate([
                    [
                        '$match' => [
                            'trading_account_id' =>  $this->tradingAccount
                        ],
                    ],
                   [
                       '$group' => [
                           '_id'   => '$_id',
                           'count' => ['$sum' => 1],
                           'data'  => ['$push' => '$$ROOT'],
                       ]
                   ],
                    [
                        '$unwind'  => ['path' => '$_id']
                    ],
                    [
                        '$set' => [
                            'hourDifference' => $analyticTradeRepository->CalculationDurationDate(
                                '$data.open' ,
                                '$data.close',
                                'hour'
                            ),
                            'minuteDifference' => $analyticTradeRepository->CalculationDurationDate(
                                '$data.open' ,
                                '$data.close',
                                'minute'
                            ),
                            'gain' => [
                                '$round' => [
                                    [
                                        '$multiply' => [
                                            [
                                                '$divide' => [['$toInt' => ['$arrayElemAt' => ['$data.profit' , 0]]] , $firstBalance]
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
                            "open_data"   => $analyticTradeRepository->BsonDateToString('$data.open'),
                            "close_date"  => $analyticTradeRepository->BsonDateToString('$data.close'),
                            "symbol"      => ['$first' => '$data.symbol'],
                            "action"      => ['$first' => '$data.order'],
                            "lots"        => ['$first' => '$data.size'],
                            "sl"          => ['$first' => '$data.sl'],
                            "tp"          => ['$first' => '$data.tp'],
                            "open_price"  => ['$first' => '$data.open_price'],
                            "close_price" => ['$first' => '$data.close_price'],
//                            "pips"        => ['$first' => ''],
                            "profit"       => ['$first' => '$data.profit'],
                            "duration"    => [
                                '$concat' => [
                                    ['$concat' => [['$toString' => '$hourDifference'] , 'h']],
                                    ' ',
                                    ['$concat' => [['$toString' => '$minuteDifference'] , 'm']],
                                ]
                            ],
                            "gain"        => '$gain'
                        ]
                    ]
                ]);
            });

        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
