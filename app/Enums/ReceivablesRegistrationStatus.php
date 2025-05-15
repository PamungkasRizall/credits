<?php

namespace App\Enums;

enum ReceivablesRegistrationStatus: int {
    case PENDING = 0;
    case IN_PROCESS = 1;
    case PAID_OFF = 2;
    case CANCEL = 3;

    public static function formStatus(): array
    {
        return [
            self::IN_PROCESS->value => self::IN_PROCESS->naming(),
            self::CANCEL->value => self::CANCEL->naming(),
        ];
    }

    public function naming(): String
    {
        return match($this)
        {
            self::PENDING => 'Pending',
            self::IN_PROCESS => 'Prosess',
            self::PAID_OFF => 'Lunas',
            self::CANCEL => 'Batal',
        };
    }

    public function coloringClasses(): String
    {
        return match($this)
        {
            self::PENDING => 'warning',
            self::IN_PROCESS => 'primary',
            self::PAID_OFF => 'success',
            self::CANCEL => 'error',
        };
    }
}
