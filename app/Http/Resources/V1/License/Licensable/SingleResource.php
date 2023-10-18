<?php

namespace App\Http\Resources\V1\License\Licensable;

use App\Http\Resources\V1\License\License\LicenseSummaryResource;
use App\Http\Resources\V1\License\Terminal\TerminalSummaryResource;
use App\Http\Resources\V1\License\Version\VersionSummaryResource;
use App\Http\Resources\V1\Post\PostSummaryResource;
use App\Http\Resources\V1\Tag\TagResource as TagSummeryResource;
use App\Http\Resources\V1\Trading\Account\AccountSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'                             => $this->id,
            'version'                          => $this->whenLoaded('version', fn() => VersionSummaryResource::make($this->version)),
            'post'                             => $this->whenLoaded('post', fn() => PostSummaryResource::make($this->post)),
            'trading_account'                  => $this->whenLoaded('tradingAccount', fn() => AccountSummaryResource::make($this->tradingAccount)),
            'license'                          => $this->whenLoaded('license', fn() => LicenseSummaryResource::make($this->license)),
            'terminal'                         => $this->whenLoaded('terminal', fn() => TerminalSummaryResource::make($this->terminal)),
            'tag'                              => $this->whenLoaded('tag', fn() => TagSummeryResource::collection($this->tag)),
            'key_type'                         => $this->key_type,
            'assigned_by'                      => $this->assigned_by,
            'token_id'                         => $this->token_id,
            'token_secret'                     => $this->token_secret,
            'private_key'                      => $this->private_key,
            'public_key'                       => $this->public_key,
            'setting'                          => $this->setting,
            'installed_at'                     => $this->installed_at,
            'activated_at'                     => $this->activated_at,
            'deactivated_at'                   => $this->deactivated_at,
            'suspended_at'                     => $this->suspended_at,
            'resumed_at'                       => $this->resumed_at,
            'expires_at'                       => $this->expires_at,
            'status'                           => $this->status,
        ];
    }
}
