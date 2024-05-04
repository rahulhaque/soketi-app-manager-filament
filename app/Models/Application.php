<?php

namespace App\Models;

use App\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Application extends Model
{
    use HasFactory;
    use HasOwnership;

    protected $casts = [
        'webhooks' => 'array',
    ];

    public function clearCache()
    {
        Redis::connection('soketi')->del('app:'.$this->key);
    }
}
