<?php

namespace App\Models\Trader4\V1\Trading;

use App\Concerns\HasMetas;
use App\Models\Trader4\V1\FinancialEngineering\CashFlow\CashFlow;
use App\Models\Trader4\V1\License\Terminal;
use App\Models\Trader4\V1\Market\Broker;
use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\Tag;
use App\Models\Trader4\V1\User\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;
    use HasMetas;

    const TABLE = 'trading_accounts';
    protected $table = self::TABLE;

    const REQUEST_GET_HANDLER = [
        'name', 'broker_id', 'market_id', 'platform_id', 'server_id', 'company', 'identity', 'secret', 'secret_read_only',
        'trade_mode', 'margin_type', 'order_limit', 'trade_allowed', 'hedge', 'capital_road', 'balance', 'credit', 'equity', 'currency', 'margin',
        'free_margin', 'margin_level', 'leverage', 'stopout_level', 'report','status','platforms','tags'
    ];

    const FILLABLE = [
        'name', 'broker_id', 'market_id', 'platform_id', 'server_id', 'company', 'identity', 'secret', 'secret_read_only',
        'trade_mode', 'margin_type', 'order_limit', 'trade_allowed', 'hedge', 'capital_road', 'balance', 'credit', 'equity', 'currency', 'margin',
        'free_margin', 'margin_level', 'leverage', 'stopout_level', 'report','status','is_public' , 'user_id'
    ];


    protected $fillable = self::FILLABLE ;


    protected $casts = [
        'balance' => 'integer',
        'credit'  => 'integer',
        'equity'  => 'integer',
        'trade_allowed' => 'boolean',
        'hedge' => 'boolean',
        'capital_road' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(Broker::class);
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class,'taggable')->select('id', 'title', 'slug', 'icon');
    }

    public function cashFlow(): HasOne
    {
        return $this->hasOne(CashFlow::class,'market_id');
    }

    public function frameworks(): hasMany
    {
        return $this->hasMany(Framework::class);
    }


    public function terminals() : hasMany
    {
        return $this->hasMany(Terminal::class);
    }

    public static function withRelational(){
        return self::with([
            'broker' => function($broker){
                return $broker->select(['id','name','logo']);
            },
            'market' => function($market){
                return $market->select(['id','name','slug','icon']);
            },
            'platform'=> function($platform){
                return $platform ?? $platform->select(['id','name','slug','icon']);
            },
            'tags'=> function($tags){
                return $tags ?? $tags->select(['id','title','slug','icon']);
            },
        ]);
    }
}
