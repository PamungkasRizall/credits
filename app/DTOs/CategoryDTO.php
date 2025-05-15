<?php

namespace App\DTOs;
class CategoryDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $name,
        public readonly string $type,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            name: $data['name'],
            type: $data['type'],
        );
    }
}

