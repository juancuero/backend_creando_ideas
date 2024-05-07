<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self ACTIVE()
 * @method static self DELETED()
 * @method static self BANNED()
 * @value string ACTIVE
 * @value string DELETED
 * @value string BANNED
 */
final class UserStatus extends Enum
{
    public static function all(): array
    {
        return [
            'ACTIVE',
            'DELETED',
            'BANNED',
        ];
    }
}
