<?php

namespace App\Enums;

enum UserRole: string {
    case AR = 'AR';
    case KOLEKTOR = 'Kolektor';
    case SALES = 'Sales';
    case SUPERVISOR = 'Supervisor';
    case SUPER_ADMIN = 'Super Admin';
    case WASDIT = 'Wasdit';

    public static function values(): array
    {
        return [
            self::AR,
            self::KOLEKTOR,
            self::SALES,
            self::SUPERVISOR,
            self::SUPER_ADMIN,
            self::WASDIT,
        ];
    }

    // public function label(): string
    // {
    //     return ucfirst($this->value);
    // }
}
