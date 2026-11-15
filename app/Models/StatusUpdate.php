<?php

namespace App\Models;

use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\Model;

class StatusUpdate extends Model
{
    protected $fillable = ['status', 'user_id', 'note'];

    protected function casts(): array
    {
        return ['status' => RequestStatus::class];
    }
}
