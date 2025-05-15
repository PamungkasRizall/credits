<?php

namespace App\DTOs;

use Carbon\Carbon;

class ReceivablesRegistrationAngsuranDTO
{
    public function __construct(
        public readonly string $model_id,
        public readonly array $angsuran,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'],
            angsuran: $data['angsuran']
        );
    }
}

