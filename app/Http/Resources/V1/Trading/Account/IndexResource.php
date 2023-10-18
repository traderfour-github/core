<?php

namespace App\Http\Resources\V1\Trading\Account;

use App\Http\Resources\V1\Market\Broker\BrokerSummaryResource;
use App\Http\Resources\V1\Market\Market\MarketSummaryResource;
use App\Http\Resources\V1\Market\Platform\PlatformSummeryResource;
use App\Http\Resources\V1\Tag\TagResource as TagSummeryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'          => $this->id,
            'name'          => $this->name,
            'company'       => $this->company,
            'identity'      => $this->identity,
            'trade_mode'    => $this->trade_mode,
            'margin_type'   => $this->margin_type,
            'order_limit'   => $this->order_limit,
            'trade_allowed' => $this->trade_allowed,
            'hedge'         => $this->hedge,
            'capital_road'  => $this->capital_road,
            'server'        => $this->server,
            'link'          => $this->link,
            'currency'      => $this->currency,
            'leverage'      => $this->leverage,
            'stopout_level' => $this->stopout_level,
            'report'        => $this->report,
            'status'        => $this->status,
            'balance'       => $this->balance,
            'credit'        => $this->credit,
            'equity'        => $this->equity,
            'margin'        => $this->margin,
            'free_margin'   => $this->free_margin,
            'margin_level'  => $this->margin_level,
            'brokers'        => $this->whenLoaded('broker', fn() => BrokerSummaryResource::make($this->broker)),
            'markets'        => $this->whenLoaded('market', fn() => MarketSummaryResource::make($this->market)),
            'platform'     => $this->whenLoaded('platform', fn() => PlatformSummeryResource::make($this->platform)),
            'tags'          => $this->whenLoaded('tags', fn() => TagSummeryResource::collection($this->tags)),
        ];
    }
}
