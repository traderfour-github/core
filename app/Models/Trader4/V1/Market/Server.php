<?php

namespace App\Models\Trader4\V1\Market;

use Database\Factories\Trader4\V1\Market\ServerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_official' => 'bool',
        'is_public' => 'bool',
    ];

    protected static function newFactory()
    {
        return ServerFactory::new();
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(Broker::class);
    }

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    public function instruments(): HasMany
    {
        return $this->hasMany(Instrument::class);
    }
}
