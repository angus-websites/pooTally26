<?php

namespace App\Enum;

enum PooColour: string
{
    case BROWN = 'brown';
    case GREEN = 'green';
    case YELLOW = 'yellow';
    case BLACK = 'black';
    case RED = 'red';

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
