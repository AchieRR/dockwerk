<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum RequestStatus: string implements HasColor, HasLabel
{
    case Reported = 'reported';
    case Scheduled = 'scheduled';
    case Completed = 'completed';

    public function getLabel(): string
    {
        return match ($this) {
            self::Reported => 'Gemeld',
            self::Scheduled => 'Ingepland',
            self::Completed => 'Afgerond',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Reported => 'warning',
            self::Scheduled => 'info',
            self::Completed => 'success',
        };
    }
}
