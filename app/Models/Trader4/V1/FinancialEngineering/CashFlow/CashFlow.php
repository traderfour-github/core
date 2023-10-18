<?php

namespace App\Models\Trader4\V1\FinancialEngineering\CashFlow;

use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashFlow extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'public' => 'bool',
        'from' => 'date',
        'till' => 'date',
    ];

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'trading_account_id');
    }

    public function financings(): HasMany
    {
        return $this->hasMany(Financing::class);
    }

    public function investings(): HasMany
    {
        return $this->hasMany(Investing::class);
    }

    public function operatings(): HasMany
    {
        return $this->hasMany(Operating::class);
    }
}
