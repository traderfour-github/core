<?php

namespace App\Models\Trader4\V1\License;

use App\Models\Trader4\V1\Post;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'licenses';

    const REQUEST_GET_HANDLER = [
        'version_id' , 'key_type' , 'private_key' , 'public_key' , 'post_id' , 'max_terminals',
        'max_accounts' , 'allowed_markets' , 'allowed_brokers' , 'allowed_countries' , 'is_real' , 'max_balance',
        'max_equity','max_volume', 'max_orders','max_symbols' , 'max_timeframes' , 'is_lifetime' , 'is_trial' , 'status'
    ];

    protected $fillable = [
        'user_id' , 'version_id' , 'key_type' , 'private_key' , 'public_key' , 'post_id' , 'max_terminals',
        'max_accounts' , 'allowed_markets' , 'allowed_brokers' , 'allowed_countries' , 'is_real' , 'max_balance',
        'max_equity','max_volume', 'max_orders','max_symbols' , 'max_timeframes' , 'is_lifetime' , 'is_trial' , 'status'
    ];

    protected $casts = [
        'max_orders' => 'integer',
        'max_symbols'  => 'integer',
        'max_timeframes'  => 'integer',
        'max_terminals' => 'integer',
        'max_volume' => 'integer',
        'max_equity' => 'integer',
        'max_balance' => 'integer',
        'key_type' => 'integer',
        'is_real' => 'boolean',
        'is_lifetime' => 'boolean',
        'is_trial' => 'boolean',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'licensable');
    }

    public static function withRelational(){
        return self::with([
            'post' => function($post){
                return $post->select(['id','title','slogan','type','status','published_at']);
            },
            'version' => function($version) {
                return $version->select(['id', 'title', 'signature']);
            }
        ]);
    }
}
