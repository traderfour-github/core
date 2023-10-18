<?php

namespace App\Models\Trader4\V1\FinancialEngineering\CashFlow;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investing extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'cash_flow_investing';

    protected $guarded = [];

    protected $casts = [
        'is_public' => 'bool',
        'from' => 'date',
        'till' => 'date',
    ];

    public function cashFlow(): BelongsTo
    {
        return $this->belongsTo(CashFlow::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function scopeOnlyFirstLevel($query)
    {
        $query->whereNull('parent_id');
    }
}
