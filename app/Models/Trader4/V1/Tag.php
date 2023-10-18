<?php

namespace App\Models\Trader4\V1;

use App\Models\Trader4\V1\License\Licensable;
use App\Models\Trader4\V1\Trading\Account;
use Database\Factories\Trader4\V1\TagFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasUuids, HasFactory, SoftDeletes ;

    protected $fillable = [
        'title',
    ];

    protected $hidden = ['pivot'];

    protected static function newFactory()
    {
        return TagFactory::new();
    }

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function tradingAccounts(): MorphToMany
    {
        return $this->morphedByMany(Account::class, 'taggable','taggables');
    }

    public function licensables(): MorphMany
    {
        return $this->morphMany(Licensable::class, 'licensable');
    }

}
