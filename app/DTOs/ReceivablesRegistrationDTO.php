<?php

namespace App\DTOs;

use Carbon\Carbon;

class ReceivablesRegistrationDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $consumer_id,
        public readonly string $product_id,
        public readonly int $item_price,
        public readonly int $tenor,
        public readonly string $bill_per_day,
        public readonly string $total,
        public readonly string $down_payment,
        public readonly Carbon $date_at,
        public readonly string $sales_id,
        public readonly string $supervisor_id,
        public readonly string $wasdit_id,
        public readonly string $ar_id,
        public readonly string $collector_id,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            consumer_id: $data['consumer_id'],
            product_id: $data['product_id'],
            item_price: $data['item_price'],
            tenor: $data['tenor'],
            bill_per_day: numericOnly($data['bill_per_day']),
            total: numericOnly($data['total']),
            down_payment: numericOnly($data['down_payment']),
            date_at: $data['date_at'],
            sales_id: $data['sales_id'],
            supervisor_id: $data['supervisor_id'],
            wasdit_id: $data['wasdit_id'],
            ar_id: $data['ar_id'],
            collector_id: $data['collector_id'],
        );
    }
}

