<?php

declare(strict_types=1);

namespace App\Enums;

enum Status: string
{

    case New = 'new';

    case Progress = 'in_progress';

    case Completed = 'completed';

    public static function toArray(): array
    {
        return [
            static::New->value,
            static::Progress->value,
            static::Completed->value,
        ];
    }

}
