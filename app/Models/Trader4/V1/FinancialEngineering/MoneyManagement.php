<?php

namespace App\Models\Trader4\V1\FinancialEngineering;

use App\Models\Trader4\V1\Market\Instrument;
use App\Models\Trader4\V1\Trading\Account;
use App\Models\Trader4\V1\Trading\Framework;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoneyManagement extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'money_managements';

    protected $fillable = [
        'instrument_id','user_id', 'title', 'position_size',
        'position_size_mode','position_size_calculation','maximum_size','minimum_size',
        'status'
    ];

    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function instrument(): BelongsTo
    {
        return $this->belongsTo(Instrument::class);
    }

    public function frameworks(): HasMany
    {
        return $this->hasMany(Framework::class);
    }
}
