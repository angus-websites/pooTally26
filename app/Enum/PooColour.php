<?php

namespace App\Enum;

enum PooColour: string
{
    case brown = 'brown';
    case green = 'green';
    case yellow = 'yellow';
    case black = 'black';
    case red = 'red';

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
