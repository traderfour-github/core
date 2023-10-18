<?php

namespace App\Http\Resources\V1\Trading\Analytics;

use Illuminate\Http\Resources\Json\JsonResource;

class TradingActivityResource extends JsonResource
{

    public function __construct(
        private $openTrades ,
        private $openOrders,
        private $histories,
        private $exposure,
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
            "trading_activity" => [
                "open_trades" => $this->openTrades,
                "open_orders" => $this->openOrders,
                "history"     => $this->histories,
                "exposure"    => $this->exposure,
            ]
        ];
    }
}
