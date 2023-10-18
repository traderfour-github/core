<?php

namespace App\Models\Trader4\V1\Market;

use App\Models\Trader4\V1\Trading\Account;
use Database\Factories\Trader4\V1\Market\BrokerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Broker extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [
        'market_id',
        'name',
        'logo',
        'website',
        'description',
        'is_dealing_desk',
        'is_stp',
        'is_ecn',
        'is_market_maker',
        'is_ndd',
        'is_dma',
        'is_prime_of_prime',
        'country',
        'offices',
        'regulations',
        'us_clients',
        'account_currencies',
        'funding_methods',
        'withdrawal_methods',
        'has_swap_free',
        'has_demo_account',
        'has_segregated_account',
        'interest_on_margin',
        'has_managed_account',
        'money_managers',
        'phone',
        'fax',
        'email',
        'languages',
        'availability',
        'has_mobile_trading',
        'has_web_trading',
        'has_api',
        'has_socket',
        'has_oco_orders',
        'allow_hedge',
        'has_trailing_stops',
        'has_one_click_trading',
        'has_bonus',
        'has_contests',
        'has_stocks',
        'has_options',
        'has_futures',
        'has_indices',
        'has_commodities',
        'has_energies',
        'has_shares',
        'has_spread_betting',
        'has_cfd',
        'has_cryptocurrencies',
        'spread',
        'five_decimals',
        'allow_scalping',
        'allow_super_scalping',
        'status',
    ];

    protected $casts = [
        'is_dealing_desk' => 'bool',
        'is_stp' => 'bool',
        'is_ecn' => 'bool',
        'is_market_maker' => 'bool',
        'is_ndd' => 'bool',
        'is_dma' => 'bool',
        'is_prime_of_prime' => 'bool',
        'us_clients' => 'bool',
        'has_swap_free' => 'bool',
        'has_demo_account' => 'bool',
        'has_segregated_account' => 'bool',
        'interest_on_margin' => 'bool',
        'has_managed_account' => 'bool',
        'has_mobile_trading' => 'bool',
        'has_web_trading' => 'bool',
        'has_api' => 'bool',
        'has_socket' => 'bool',
        'has_oco_orders' => 'bool',
        'allow_hedge' => 'bool',
        'has_trailing_stops' => 'bool',
        'has_one_click_trading' => 'bool',
        'has_bonus' => 'bool',
        'has_contests' => 'bool',
        'has_stocks' => 'bool',
        'has_options' => 'bool',
        'has_futures' => 'bool',
        'has_indices' => 'bool',
        'has_commodities' => 'bool',
        'has_energies' => 'bool',
        'has_shares' => 'bool',
        'has_spread_betting' => 'bool',
        'has_cfd' => 'bool',
        'has_cryptocurrencies' => 'bool',
        'five_decimals' => 'bool',
        'allow_scalping' => 'bool',
        'allow_super_scalping' => 'bool',
        'offices' => 'json',
        'regulations' => 'json',
        'funding_methods' => 'json',
        'withdrawal_methods' => 'json',
        'money_managers' => 'json',
        'availability' => 'json',
    ];

    public static array $booleanFields = [
        'is_dealing_desk',
        'is_stp',
        'is_ecn',
        'is_market_maker',
        'is_ndd',
        'is_dma',
        'is_prime_of_prime',
        'us_clients',
        'has_swap_free',
        'has_demo_account',
        'has_segregated_account',
        'interest_on_margin',
        'has_managed_account',
        'has_mobile_trading',
        'has_web_trading',
        'has_api',
        'has_socket',
        'has_oco_orders',
        'allow_hedge',
        'has_trailing_stops',
        'has_one_click_trading',
        'has_bonus',
        'has_contests',
        'has_stocks',
        'has_options',
        'has_futures',
        'has_indices',
        'has_commodities',
        'has_energies',
        'has_shares',
        'has_spread_betting',
        'has_cfd',
        'has_cryptocurrencies',
        'five_decimals',
        'allow_scalping',
        'allow_super_scalping',
    ];

    public static array $jsonFields = [
        'offices',
        'regulations',
        'funding_methods',
        'withdrawal_methods',
        'money_managers',
        'availability',
    ];

    public static array $stringFields = [
        'market_id',
        'name',
        'description',
        'country',
        'account_currencies',
        'phone',
        'fax',
        'email',
        'languages',
    ];

    public static array $integerFields = [
        'spread',
        'status',
    ];

    protected static function newFactory()
    {
        return BrokerFactory::new();
    }

    public function platforms(): HasMany
    {
        return $this->hasMany(Platform::class);
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }

    public function tradingAccounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
