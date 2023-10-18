<?php

namespace App\Repositories\V1\Trading\Analytics;

use App\Models\Trader4\V1\Trading\Trade;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function example\int;

class AnalyticTradeRepository extends AbstractRepository
{

    protected function instance(array $attributes = []): Model
    {
        return new Trade();
    }


    public function fetchTrades($trading_account)
    {
        return $this->model->where([
            'trading_account_id' => $trading_account
        ])->get();
    }


    public function prepareQueryTrades($trading_account)
    {
        return DB::connection('mongodb')->collection('trades')
            ->whereRaw([
                'trading_account_id' => $trading_account
            ]);
    }

    public function prepareQueryMongodb()
    {
        return $this->model;
    }


    public function getQueryByDate(int $startSeconds , int $endSeconds ,string $field, string $tradingAccount) {

        $query = $this->model->raw(function ($coll) use($startSeconds , $endSeconds , $tradingAccount){
            return $coll->aggregate([
                [
                    '$match' => [
                        'trading_account_id' =>  $tradingAccount,
                        '$expr' => [
                            '$and' => [
                                ['$gte' => ['$created_at' , ['$toDate' => ['$subtract' => ['$$NOW' , $endSeconds]]]]],
                                ['$lt'  => ['$created_at' , ['$toDate' => ['$subtract' => [ '$$NOW' , $startSeconds]]]]],
                            ]
                        ]

                    ],
                ],
                [
                    '$group' => [
                        '_id'   => null,
                        'lots' => [
                            '$sum' => '$size'
                        ] ,
                        'count' => [
                            '$sum' => 1
                        ],
                        'profit' => [
                            '$sum' => '$profit'
                        ]
                    ]
                ],
                [
                    '$project' => [
                        '_id' => 0
                    ]
                ]
            ]);
        });

        if(!$query->isEmpty())
            return $query[0][$field];
    }

    public function BsonDateToString($date) : array{
        return [
            '$dateToString' => ['format' => '%m.%d.%Y %H:%M' , 'date' => ['$first' => $date]]
        ];
    }


    public function CalculationDurationDate($startDate , $endDate , $unit){

        return  [
            '$abs' => [
                '$avg' => [
                    '$dateDiff' => [
                        'startDate' => ['$first' => $startDate],
                        'endDate'   => ['$first' => $endDate],
                        'unit'      => $unit
                    ]
                ]
            ]
        ];

    }
}
