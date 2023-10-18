<?php

namespace App\Http\Resources\V1\Trading\Analytics;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvancedStatisticsResource extends JsonResource
{

    public function __construct(
        private $totalTrade ,
        private $avgWonTrade,
        private $avgLostTrade,
        private $profitabilityWon ,
        private $profitabilityLost,
        private $profitFactor ,
        private $sumLot,
        private $bestTrade,
        private $worstTrade,
        private $longWonTrade,
        private $shortWonTrade,
        private $sumCommission,
        private $countLongTrade,
        private $countShortTrade,
        private $avgTradeLength,
        private $expectancy,
        private $summaryStatistics
    ){}


    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "advanced_statistics" => [
                "trades" => [
                    "trades"        => $this->totalTrade,
                    "profitability"  => [
                        "won"   => $this->profitabilityWon,
                        "lost"  => $this->profitabilityLost
                    ],
                    "pips"                => "" ,
                    "average_win"         => [
                        "pips"    => $this->avgWonTrade["pips"],
                        "money"   => $this->avgWonTrade["money"]
                    ],
                    "average_loss"        => [
                        "pips"    => $this->avgLostTrade["pips"],
                        "money"   => $this->avgLostTrade["money"]
                    ],
                    "lots"                => $this->sumLot,
                    "commissions"         => $this->sumCommission,
                    "longs_won"           => [
                        "percent"  => $this->longWonTrade,
                        "number"   => "($this->countLongTrade/$this->totalTrade)"
                    ],
                    "shorts_won"           => [
                        "percent"  => $this->shortWonTrade,
                        "number"   => "($this->countShortTrade/$this->totalTrade)"
                    ],
                    "best_trade"          => [
                        "this"    => $this->bestTrade["this"],
                        "date"    => $this->bestTrade["date"]
                    ],
                    "worst_trade"         => [
                        "this"    => $this->worstTrade["this"],
                        "date"    => $this->worstTrade["date"]
                    ],
                    "avg_trade_length"    => $this->avgTradeLength,
                    "profit_factor"        => $this->profitFactor,
                    "standard_deviation"  => "" ,
                    "sharpe_ratio"        => "",
                    "z_score"             => "",
                    "expectancy"          => [
                        "pips"    => $this->expectancy['pips'],
                        "money"   => $this->expectancy['money']
                    ],
                    "ahpr"                => "",
                    "ghpr"                => "",

                ],
                "summary" => $this->summaryStatistics ,
                "hourly" => [

                ],
                "daily" => [

                ],
                "duration" => [

                ],
                "mae_mfe" => [

                ],
            ]
        ];
    }
}
