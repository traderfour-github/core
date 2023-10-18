<?php

namespace App\Models\Trader4\V1\FinancialEngineering;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TradingStrategyExit extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'source_settings' => 'json',
        'is_required' => 'bool',
    ];

    public function tradingStrategy(): BelongsTo
    {
        return $this->belongsTo(TradingStrategy::class);
    }
}
