<?php

namespace App\Http\Resources\V1\Trading\Analytics;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
{

    public function __construct(
        private $firstBalance ,
        private $currentBalance,
        private $drawdown,
        private $currentEquity,
        private $maxEquity,
        private $tradingAccount,
        private $profit,
        private $gain,
        private $gainDaily,
        private $gainMonthly,
        private $gainAbs,
        private $interest,
        private $withdrawals
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
            "info" => [
                "stats" => [
                    "gain"     => $this->gain,
                    "abs_gain" => $this->gainAbs,
                    "daily"    => $this->gainDaily,
                    "monthly"  => $this->gainMonthly,
                    "drawdown" => $this->drawdown,
                    "balance"  => $this->currentBalance,
                    "equity"   => $this->currentEquity,
                    "highest"  => $this->maxEquity,
                    "profit"    => $this->profit,
                    "interest" => $this->interest,
                    "deposits" => $this->firstBalance,
                    "withdrawals" => $this->withdrawals
                ],
                "general" => [
                    "views"     => "" ,
                    "broker"    => $this->tradingAccount->broker->name ,
                    "leverage"  => $this->tradingAccount->broker->leverage  ,
                    "type"      => $this->tradingAccount->trade_mode ,
                    "system"    => "" ,
                    "trading"   => "",
                    "started"   => $this->tradingAccount->broker->created_at,
                    "added"     => "",
                    "timezone"  => ""
                ]
            ]
        ];
    }
}
