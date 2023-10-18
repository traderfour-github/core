<?php

namespace App\Models\Trader4\V1;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'json'
    ];

    public function metaable()
    {
        return $this->morphTo();
    }
}
