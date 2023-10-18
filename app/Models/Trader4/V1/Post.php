<?php

namespace App\Models\Trader4\V1;

use App\Models\Trader4\V1\License\License;
use App\Models\Trader4\V1\License\Version;
use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\User\Attachment;
use Briofy\FileSystem\Traits\HasAttachments;
use Database\Factories\Trader4\V1\Post\PostFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;
//    use HasAttachments;

    protected $fillable = [
        'user_id', 'title', 'slogan', 'excerpt', 'content', 'download_count',
        'view_count', 'purchase_count', 'comment_count', 'popularity_score', 'comments', 'type',
        'is_public', 'is_featured', 'is_pinned', 'for_kids', 'last_update', 'published_at', 'status'
    ];

    protected $casts = [
        'download_count' => 'integer',
        'view_count' => 'integer',
        'purchase_count' => 'integer',
        'comment_count' => 'integer',
        'popularity_score' => 'integer',
        'is_public' => 'boolean',
        'is_featured' => 'boolean',
        'is_pinned' => 'boolean',
        'for_kids' => 'boolean',
        'last_update' => 'date',
        'published_at' => 'date',
        'status' => 'integer',
    ];

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    public function logo(): BelongsTo
    {
        return $this->belongsTo(Attachment::class);
    }

    public function cover(): BelongsTo
    {
        return $this->belongsTo(Attachment::class);
    }

    public function license(): HasMany
    {
        return $this->hasMany(License::class);
    }

    public function version(): HasMany
    {
        return $this->hasMany(Version::class);
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class,'taggable')->select('id', 'title', 'slug', 'icon');
    }

    public function attachments(): MorphToMany
    {
        return $this->morphToMany(Attachment::class,'attachmentable');
    }

    public function platforms(): MorphToMany
    {
        return $this->morphToMany(Platform::class,'platformable');
    }

    public function markets(): MorphToMany
    {
        return $this->morphToMany(Market::class,'marketable');
    }

    public function licenses(): MorphToMany
    {
        return $this->morphToMany(License::class,'licensable');
    }
}
