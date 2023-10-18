<?php

namespace App\Models\Trader4\V1\Market;

use App\Models\Trader4\V1\Post;
use App\Models\Trader4\V1\Trading\Account;
use Database\Factories\Trader4\V1\Market\PlatformFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'platforms';

    protected $fillable = [
        'title',
        'slogan',
        'icon',
        'url',
    ];

    protected $casts = [
        'permissions' => 'json',
        'oss'         => 'json',
    ];

    protected static function newFactory()
    {
        return PlatformFactory::new();
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(Broker::class);
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'platformable');
    }

    public function instruments(): HasMany
    {
        return $this->hasMany(Instrument::class);
    }

    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }

    public function tradingAccounts(): MorphToMany
    {
        return $this->morphedByMany(Account::class, 'platformable' , 'platformables');
    }
}
