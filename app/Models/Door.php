<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Door extends Model
{
    protected $fillable = ['code', 'name', 'location'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
