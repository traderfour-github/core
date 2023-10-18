<?php

namespace App\Models\Trader4\V1\License;

use App\Models\Trader4\V1\Post;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terminal extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'terminals';

    const REQUEST_GET_HANDLER = [
        'assigned_by' , 'trading_account_id' , 'bulut_id' , 'ip_address' , 'mac_address' , 'name', 'version', 'build',
        'path' , 'language' , 'country' , 'timezone' , 'installed_at' , 'last_seen', 'status'
    ];

    protected $fillable = [
        'user_id' , 'assigned_by' , 'trading_account_id' , 'bulut_id' , 'ip_address' , 'mac_address' , 'name',
        'version', 'build', 'path' , 'language' , 'country' , 'timezone' , 'installed_at' , 'last_seen', 'status'
    ];

    protected $casts = [
        'installed_at' => 'datetime',
        'last_seen'  => 'datetime',
    ];

    public function tradingAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }


    public static function withRelational(){
        return self::with([
            'tradingAccount' => function($tradingAccount){
                return $tradingAccount->select(['id','name','identity']);
            },
        ]);
    }
}
