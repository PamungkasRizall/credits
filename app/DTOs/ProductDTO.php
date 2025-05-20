<?php

namespace App\DTOs;
class ProductDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $name,
        public readonly ?string $notes,
        public readonly int $merk_id,
        public readonly string $type,
        public readonly int $unit_id,
        public readonly int $hpp,
        public readonly int $price,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            name: $data['name'],
            notes: $data['notes'] ?? null,
            merk_id: $data['merk_id'],
            type: $data['type'],
            unit_id: $data['unit_id'],
            hpp: numericOnly($data['hpp']),
            price: numericOnly($data['price']),
        );
    }
}

