<?php

namespace App\Models\Trader4\V1\FinancialEngineering;

use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TradingStrategy extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'public' => 'bool',
    ];

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function riskManagement(): BelongsTo
    {
        return $this->belongsTo(RiskManagement::class);
    }

    public function moneyManagement(): BelongsTo
    {
        return $this->belongsTo(MoneyManagement::class);
    }

    public function tradingPlan(): BelongsTo
    {
        return $this->belongsTo(TradingPlan::class);
    }
}
