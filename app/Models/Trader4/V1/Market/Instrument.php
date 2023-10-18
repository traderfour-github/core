<?php

namespace App\Models\Trader4\V1\Market;

use Database\Factories\Trader4\V1\Market\InstrumentFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instrument extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'margin_rate' => 'json',
        'swap_rate' => 'json',
        'sessions' => 'json',
    ];

    protected static function newFactory()
    {
        return InstrumentFactory::new();
    }

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(Broker::class);
    }

    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
