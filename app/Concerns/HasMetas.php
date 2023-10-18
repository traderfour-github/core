<?php

namespace App\Concerns;

use App\Models\Trader4\V1\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMetas
{

    public function metas(): MorphMany
    {
        return $this->morphMany(Meta::class, 'metaable');
    }
}
