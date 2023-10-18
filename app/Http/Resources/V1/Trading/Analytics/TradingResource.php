<?php

namespace App\Http\Resources\V1\Trading\Analytics;

use Illuminate\Http\Resources\Json\JsonResource;

class TradingResource extends JsonResource
{

    public function __construct(
        private $differenceTrade ,
        private $differenceLot,
        private $differenceProfit,
        private $differenceGain,
        private $differenceWin,
        private $differencePip
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
            "trading" => [
                "periods " => [
                    "today" => [
                        "gain"   => [
                            "this"        => $this->differenceGain['this_today'],
                            "difference"  => $this->differenceGain['difference_today']
                        ] ,
                        "profit"  => [
                            "this"        => $this->differenceProfit['this_today'],
                            "difference"  => $this->differenceProfit['difference_today']
                        ] ,
                        "pips"   => [
                            "this"        => $this->differencePip['this_today'],
                            "difference"  => $this->differencePip['difference_today']
                        ] ,
                        "win"     => [
                            "this"        => $this->differenceWin['this_today'],
                            "difference"  => $this->differenceWin['difference_today']
                        ] ,
                        "trades" => [
                            "this"        => $this->differenceTrade['this_today'],
                            "difference"  => $this->differenceTrade['difference_today']
                        ] ,
                        "lots"   => [
                            "this"         => $this->differenceLot['this_today'],
                            "difference"   => $this->differenceLot['difference_today']
                        ]
                    ],
                    "this_week" => [
                        "gain"   => [
                            "this"        => $this->differenceGain['this_week'],
                            "difference"  => $this->differenceGain['difference_week']
                        ] ,
                        "profit"  => [
                            "this"        => $this->differenceProfit['this_week'],
                            "difference"  => $this->differenceProfit['difference_week']
                        ] ,
                        "pips"    => [
                            "this"        => $this->differencePip['this_week'],
                            "difference"  => $this->differencePip['difference_week']
                        ] ,
                        "win"    => [
                            "this"        => $this->differenceWin['this_week'],
                            "difference"  => $this->differenceWin['difference_week']
                        ] ,
                        "trades" => [
                            "this"        => $this->differenceTrade['this_week'],
                            "difference"  => $this->differenceTrade['difference_week']
                        ] ,
                        "lots"   => [
                            "this"         => $this->differenceLot['this_week'],
                            "difference"   => $this->differenceLot['difference_week']
                        ]
                    ],
                    "this_month" => [
                        "gain"   => [
                            "this"        => $this->differenceGain['this_month'],
                            "difference"  => $this->differenceGain['difference_month']
                        ] ,
                        "profit"  => [
                            "this"        => $this->differenceProfit['this_month'],
                            "difference"  => $this->differenceProfit['difference_month']
                        ] ,
                        "pips"    => [
                            "this"        => $this->differencePip['this_month'],
                            "difference"  => $this->differencePip['difference_month']
                        ] ,
                        "win"     => [
                            "this"        => $this->differenceWin['this_month'],
                            "difference"  => $this->differenceWin['difference_month']
                        ] ,
                        "trades" => [
                            "this"        => $this->differenceTrade['this_month'],
                            "difference"  => $this->differenceTrade['difference_month']
                        ] ,
                        "lots"   => [
                            "this"         => $this->differenceLot['this_month'],
                            "difference"   => $this->differenceLot['difference_month']
                        ]
                    ],
                    "this_year" => [
                        "gain"   => [
                            "this"        => $this->differenceGain['this_year'],
                            "difference"  => $this->differenceGain['difference_year']
                        ] ,
                        "profit"  => [
                            "this"        => $this->differenceProfit['this_year'],
                            "difference"  => $this->differenceProfit['difference_year']
                        ] ,
                        "pips"     => [
                            "this"        => $this->differencePip['this_year'],
                            "difference"  => $this->differencePip['difference_year']
                        ] ,
                        "win"    => [
                            "this"        => $this->differenceWin['this_year'],
                            "difference"  => $this->differenceWin['difference_year']
                        ] ,
                        "trades" => [
                            "this"        => $this->differenceTrade['this_year'],
                            "difference"  => $this->differenceTrade['difference_year']
                        ] ,
                        "lots"   => [
                            "this"         => $this->differenceLot['this_year'],
                            "difference"   => $this->differenceLot['difference_year']
                        ]
                    ],
                ]
            ]
        ];
    }
}
