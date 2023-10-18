<?php

namespace App\Models\Trader4\V1\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Concerns\HasMetas;
use App\Models\Trader4\V1\Post;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasUuids, HasFactory, Notifiable,
        HasMetas, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'mobile',
        'phone_number',
        'country',
        'language',
        'timezone',
        'currency',
        'referrer_id',
        'joined_friends',
        'last_connection',
        'private',
        'latitude',
        'longitude',
        'avatar',
        'status',
    ];

    protected $casts = [
        'last_connection' => 'datetime',
        'private' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function tradingAccounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function attachments(): MorphToMany
    {
        return $this->morphToMany(Attachment::class,'attachmentable');
    }
}
