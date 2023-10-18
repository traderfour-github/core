<?php

namespace App\Models\Trader4\V1\License;

use App\Models\Trader4\V1\Post;
use App\Models\Trader4\V1\Tag;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Licensable extends Model
{
    use HasUuids, HasFactory, SoftDeletes ;

    protected $table = 'licensables';

    public $keyType ='string';

    const REQUEST_GET_HANDLER = [
        'assigned_by' , 'trading_account_id' , 'post_id' , 'license_id' , 'version_id' , 'terminal_id',
        'token_id' , 'token_secret' , 'key_type' , 'private_key', 'status' , 'expires_at', 'resumed_at' ,
        'public_key','setting', 'installed_at','activated_at' , 'deactivated_at' , 'suspended_at'
    ];

    protected $fillable = [
        'user_id' , 'assigned_by' , 'trading_account_id' , 'post_id' , 'license_id' , 'version_id' , 'terminal_id',
        'token_id' , 'token_secret' , 'key_type' , 'private_key', 'licensable_id' ,'licensable_type',
        'public_key','setting', 'installed_at','activated_at' , 'deactivated_at' , 'suspended_at' , 'resumed_at' ,
        'status' , 'expires_at'
    ];

    protected $casts = [
        'key_type' => 'integer',
        'setting'  => 'json',
        'installed_at'  => 'datetime',
        'activated_at'  => 'datetime',
        'deactivated_at'  => 'datetime',
        'suspended_at'  => 'datetime',
        'resumed_at'  => 'datetime',
        'expires_at'  => 'datetime',
    ];


    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    public function license(): BelongsTo
    {
        return $this->belongsTo(License::class);
    }

    public function terminal(): BelongsTo
    {
        return $this->belongsTo(Terminal::class);
    }

    public function tag()
    {
        return $this->morphedByMany(Tag::class,'licensable','licensables');
    }

    public function licensable() : MorphTo{
        return $this->morphTo(Licensable::class, 'licensable_type', 'licensable_id', 'id');
    }

    public static function withRelational(){
        return self::with([
            'post' => function($post){
                return $post->select(['id','title','slogan','type','status','published_at']);
            },
            'version' => function($version) {
                return $version->select(['id', 'title', 'signature']);
            },
            'license' => function($license) {
                return $license->select(['id', 'key_type', 'public_key']);
            },
            'tradingAccount' => function($tradingAccount){
                return $tradingAccount->select(['id','name','identity','currency','balance','equity','status']);
            },
            'terminal' => function($terminal){
                return $terminal->select(['id','name','assigned_by']);
            },
            'tag' =>  function($tag){
                return $tag->select(['id','title','slug']);
            },
        ]);
    }
}
