<?php

namespace App\DTOs;

use Carbon\Carbon;

class ReceivablesRegistrationStatusDTO
{
    public function __construct(
        public readonly string $model_id,
        public readonly int $status,
        public readonly int $tenor,
        public readonly Carbon $date_at,
        public readonly array $awd,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'],
            status: $data['status'],
            tenor: $data['tenor'],
            date_at: Carbon::parse($data['date_at_installment']),
            awd: $data['awd']
        );
    }
}

