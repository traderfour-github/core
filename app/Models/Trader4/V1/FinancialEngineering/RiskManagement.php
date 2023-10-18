<?php

namespace App\Models\Trader4\V1\FinancialEngineering;

use App\Models\Trader4\V1\Trading\Account;
use App\Models\Trader4\V1\Trading\Framework;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiskManagement extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $table = 'risk_managements';

    protected $fillable = [
        'trading_account_id',
        'user_id',
        'title',
        'max_risk',
        'max_risk_mode',
        'max_risk_calculation',
        'is_max_risk_relative',
        'max_daily_risk',
        'max_daily_risk_mode',
        'max_daily_risk_calculation',
        'risk_per_chart',
        'risk_per_chart_mode',
        'risk_per_chart_calculation',
        'risk_per_trade',
        'risk_per_trade_mode',
        'risk_per_trade_calculation',
        'risk_reward_ratio',
        'positive_correlation',
        'negative_correlation',
        'low_correlation',
        'hedge',
        'required_target_profit',
        'news_trading',
        'allowed_instruments',
        'allowed_times',
        'allowed_order_types',
        'is_public',
    ];

    protected $casts = [
        'positive_correlation' => 'json',
        'negative_correlation' => 'json',
        'low_correlation' => 'json',
        'news_trading' => 'json',
        'allowed_instruments' => 'json',
        'allowed_times' => 'json',
        'allowed_order_types' => 'json',
        'is_max_risk_relative' => 'bool',
        'hedge' => 'bool',
        'required_stop_loss' => 'bool',
        'required_target_profit' => 'bool',
        'public' => 'bool',
    ];

    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function frameworks(): hasMany
    {
        return $this->hasMany(Framework::class);
    }
}
