<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOwnership
{
    public function scopeOwnershipAware($query)
    {
        if (auth()->user()->is_admin) {
            return $query;
        }

        return $query->where($this->getTable().'.created_by', auth()->id());
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
