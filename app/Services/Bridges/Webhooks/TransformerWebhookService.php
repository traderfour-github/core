<?php

namespace App\Services\Bridges\Webhooks;


class TransformerWebhookService
{
    public function perform($data) : array
    {
        return [
            "payload" => [
                "trading_account"  => $data["trading_account"],
                "command"          => "OrderSend" ,
                "arguments"        => [
                    "symbol"        => $data["instrument"],
                    "order"         => $data["order"],
                    "stop_loss"     => $data["stop_loss"],
                    "target_price"  => $data["target_price"],
                    "risk"          => $data["risk"],
                    "risk_mode"     => $data["risk_mode"],
                ]
            ]
        ];
    }
}
