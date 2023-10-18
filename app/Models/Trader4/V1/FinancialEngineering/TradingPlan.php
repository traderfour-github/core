<?php

namespace App\Models\Trader4\V1\FinancialEngineering;

use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Trading\Account;
use App\Models\Trader4\V1\Trading\Framework;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TradingPlan extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'daily_finish_exit' => 'bool',
        'public' => 'bool',
    ];

    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function frameworks(): hasMany
    {
        return $this->hasMany(Framework::class);
    }
}
