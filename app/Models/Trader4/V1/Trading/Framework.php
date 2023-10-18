<?php

namespace App\Models\Trader4\V1\Trading;

use App\Models\Trader4\V1\FinancialEngineering\MoneyManagement;
use App\Models\Trader4\V1\FinancialEngineering\RiskManagement;
use App\Models\Trader4\V1\FinancialEngineering\TradingPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\User\User;
use Illuminate\Database\Eloquent\Model;

class Framework extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'trading_frameworks';

    const REQUEST_GET_HANDLER = [
        'market_id', 'trading_account_id', 'risk_management_id', 'trading_plan_id', 'money_management_id',
        'title', 'reverse_positioning', 'trail_entry_step', 'trail_entry_stop', 'virtual_price', 'magic_number',
        'max_slippage', 'max_spread', 'position_management', 'partial_close', 'partial_close_calculation',
        'risk_free_step', 'risk_free_calculation', 'risk_free_extras', 'risk_free_swap_calculate', 'trail_stop_loss',
        'trail_stop_loss_calculation', 'trail_stop_loss_step', 'trail_stop_loss_step_calculation', 'max_anti_martingale',
        'consecutive_stop_hits', 'anti_martingale_multiplier', 'reward_multiplier_method', 'reward_multiplier_setting',
        'nearest_trade', 'rounded_numbers_zero_digits', 'rounded_numbers_max_distance', 'max_daily_profit',
        'max_daily_profit_mode', 'max_daily_profit_calculation', 'max_daily_loss', 'max_daily_loss_mode',
        'max_daily_loss_calculation', 'equity_protector', 'equity_protector_mode', 'equity_protector_stop_out',
        'session_london', 'session_london_start', 'session_london_end', 'session_new_york', 'session_new_york_start',
        'session_new_york_end', 'session_sydney', 'session_sydney_start', 'session_sydney_end', 'session_tokyo',
        'session_tokyo_start', 'session_tokyo_end', 'session_frankfurt', 'session_frankfurt_start',
        'session_frankfurt_end', 'news_trading', 'news_trading_before', 'news_trading_after', 'news_trading_impact',
        'opposite_trading', 'status',
    ];

    protected $fillable = [
        'user_id', 'market_id', 'trading_account_id', 'risk_management_id', 'trading_plan_id', 'money_management_id',
        'title', 'reverse_positioning', 'trail_entry_step', 'trail_entry_stop', 'virtual_price', 'magic_number',
        'max_slippage', 'max_spread', 'position_management', 'partial_close', 'partial_close_calculation',
        'risk_free_step', 'risk_free_calculation', 'risk_free_extras', 'risk_free_swap_calculate',
        'trail_stop_loss', 'trail_stop_loss_calculation', 'trail_stop_loss_step', 'trail_stop_loss_step_calculation', 'max_anti_martingale',
        'consecutive_stop_hits', 'anti_martingale_multiplier', 'reward_multiplier_method', 'reward_multiplier_setting',
        'nearest_trade', 'rounded_numbers_zero_digits', 'rounded_numbers_max_distance', 'max_daily_profit',
        'max_daily_profit_mode', 'max_daily_profit_calculation', 'max_daily_loss', 'max_daily_loss_mode',
        'max_daily_loss_calculation', 'equity_protector', 'equity_protector_mode', 'equity_protector_stop_out',
        'session_london', 'session_london_start', 'session_london_end', 'session_new_york', 'session_new_york_start',
        'session_new_york_end', 'session_sydney', 'session_sydney_start', 'session_sydney_end', 'session_tokyo',
        'session_tokyo_start', 'session_tokyo_end', 'session_frankfurt', 'session_frankfurt_start',
        'session_frankfurt_end', 'news_trading', 'news_trading_before', 'news_trading_after', 'news_trading_impact',
        'opposite_trading', 'status', 'public',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function riskManagement(): BelongsTo
    {
        return $this->belongsTo(RiskManagement::class);
    }

    public function tradingPlan(): BelongsTo
    {
        return $this->belongsTo(TradingPlan::class);
    }

    public function moneyManagement(): BelongsTo
    {
        return $this->belongsTo(MoneyManagement::class);
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }


    public static function withRelational(){
        return self::with([
            'tradingAccount' => function($tradingAccount){
                return $tradingAccount->select(['id','name','identity']);
            },
            'market' => function($market){
                return $market->select(['id','name','slug','icon']);
            },
            'riskManagement'=> function($riskManagement){
                return $riskManagement->select(['id','title']);
            },
            'tradingPlan'=> function($tradingPlan){
                return $tradingPlan ?? $tradingPlan->select(['id','instruments']);
            },
            'moneyManagement'=> function($moneyManagement){
                return $moneyManagement ?? $moneyManagement->select(['id','title']);
            },
        ]);
    }
}
