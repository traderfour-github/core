<?php

namespace App\Models\Trader4\V1\Trading;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Trade extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    const TABLE = 'trades';

    protected $table = self::TABLE;

    protected $collection = 'trades';


    protected $connection = 'mongodb';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'datetime'
    ];


    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
