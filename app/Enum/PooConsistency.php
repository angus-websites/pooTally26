<?php

namespace App\Enum;

enum PooConsistency: string
{
    case RUNNY = 'runny';
    case NORMAL = 'normal';
    case HARD = 'hard';

    /**
     * Return all enum values as an array
     */
    public static function values(): array
    {
        return array_map(
            fn (self $case) => $case->value,
            self::cases()
        );
    }
}
