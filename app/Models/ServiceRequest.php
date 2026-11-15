<?php

namespace App\Models;

use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceRequest extends Model
{
    protected $fillable = ['door_id', 'reported_by', 'title', 'description'];

    protected $attributes = ['status' => 'reported'];

    protected function casts(): array
    {
        return ['status' => RequestStatus::class, 'scheduled_for' => 'date'];
    }

    public function door(): BelongsTo
    {
        return $this->belongsTo(Door::class);
    }

    public function updates(): HasMany
    {
        return $this->hasMany(StatusUpdate::class);
    }

    public function getReferenceAttribute(): string
    {
        return 'DW-'.str_pad((string) $this->id, 4, '0', STR_PAD_LEFT);
    }
}
