<?php

namespace App\Http\Resources\V1\Trading\Analytics;

use Illuminate\Http\Resources\Json\JsonResource;

class ChartResource extends JsonResource
{

    public function __construct(
        private $balance ,
        private $profit,
        private $growth,
        private $drawdown
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
            "chart" => [
                "growth" => [
                    'balance' => $this->growth['growth_balance'],
                    'equity'  => $this->growth['growth_equity']
                ],
                "balance" => [
                    'this'    => $this->balance['balance'],
                    'equity'  => $this->balance['equity']
                ],
                "profit" => [
                    'sequence'    => $this->profit['sequence'],
                ],
                "drawdown" => $this->drawdown
            ]
        ];
    }
}
