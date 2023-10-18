<?php

namespace App\Models\Trader4\V1\License;

use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\Post;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    const REQUEST_GET_HANDLER = [
        'post_id' , 'platform_id' , 'title' , 'signature' , 'file' , 'user_manual', 'change_log','update_type',
        'major' , 'minor' , 'patch' , 'force' , 'downloads' , 'requests', 'published_at' ,'last_update' ,'status'
    ];

    protected $fillable =  [
        'user_id','post_id' , 'platform_id' , 'title' , 'signature' , 'file' , 'user_manual', 'change_log','update_type',
        'major' , 'minor' , 'patch' , 'force' , 'downloads' , 'requests', 'published_at' ,'last_update' ,'status'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    public static function withRelational(){
        return self::with([
            'post' => function($post){
                return $post->select(['id','title','slogan','type','status','published_at']);
            },
            'platform' => function($platform) {
                return $platform->select(['id', 'title', 'slug', 'icon']);
            }
        ]);
    }
}
