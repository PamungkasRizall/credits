<?php

namespace App\Enums;

enum CategoryType: string {
    case MERK = 'Merk';
    case UNIT = 'Unit';
    case REALIONSHIP = 'Hubungan Keluarga';
    case TENOR = 'Tenor';
    case USER_CATEGORY = 'Kategori User';

    public static function values(): array
    {
        return [
            self::MERK,
            self::UNIT,
            self::REALIONSHIP,
            self::TENOR,
            self::USER_CATEGORY,
        ];
    }

    // public function label(): string
    // {
    //     return ucfirst($this->value);
    // }
}
