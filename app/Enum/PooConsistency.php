<?php

namespace App\Enum;

enum PooConsistency: string
{
    case runny = 'runny';
    case normal = 'normal';
    case hard = 'hard';

    /**
     * Return all enum values as an array
     */
    public static function values(): array
    {
        return array_map(
            fn(self $case) => $case->value,
            self::cases()
        );
    }
}
