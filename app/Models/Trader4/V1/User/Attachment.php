<?php

namespace App\Models\Trader4\V1\User;

use App\Models\Trader4\V1\Post;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = ['path', 'type', 'user_id'];

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'attachmentable');
    }

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class,'attachmentable');
    }
}
