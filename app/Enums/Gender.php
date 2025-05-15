<?php

namespace App\Enums;

enum Gender: int {
    case MALE = 0;
    case FEMALE = 1;

    public static function values(): array
    {
        return [
            self::MALE->value => self::MALE->naming(),
            self::FEMALE->value => self::FEMALE->naming(),
        ];
    }

    public function naming(): String
    {
        return match($this)
        {
            self::MALE => 'Pria',
            self::FEMALE => 'Wanita',
        };
    }
}
