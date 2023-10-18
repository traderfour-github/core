<?php

namespace App\Models\Trader4\V1\Market;

use App\Models\Trader4\V1\FinancialEngineering\CashFlow\CashFlow;
use App\Models\Trader4\V1\Trading\Framework;
use Database\Factories\Trader4\V1\Market\MarketFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Market extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'icon', 'url', 'description', 'content', 'cover', 'status',
        'parent_id'
    ];

    protected static function newFactory()
    {
        return MarketFactory::new();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function brokers(): HasMany
    {
        return $this->hasMany(Broker::class);
    }

    public function platforms(): HasMany
    {
        return $this->hasMany(Platform::class);
    }

    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }

    public function frameworks(): HasMany
    {
        return $this->hasMany(Framework::class);
    }

    public function scopeOnlyFirstLevel($query)
    {
        $query->whereNull('parent_id');
    }
    public function cashFlow()
    {
        return $this->hasOne(CashFlow::class,'market_id');
    }
}
