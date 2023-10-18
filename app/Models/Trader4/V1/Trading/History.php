<?php

namespace App\Models\Trader4\V1\Trading;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;

class History extends Model
{
    use HasUuids, HasFactory;

    const TABLE = 'trading_account_histories';

    protected $table = self::TABLE;

    protected $connection = 'mongodb';

    protected $fillable = [
        'trading_account_id', 'balance', 'credit', 'equity', 'margin', 'free_margin', 'margin_level',
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'balance' => 'integer',
        'credit'  => 'integer',
        'equity'  => 'integer',
    ];

    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
