<?php

namespace App\DTOs;
class UserDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $name,
        public readonly string $username,
        public readonly int $category_id,
        public readonly string $phone,
        public readonly ?string $password,
        public readonly ?string $password_confirmation,
        public readonly array $roles,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            name: $data['name'],
            username: $data['username'],
            category_id: $data['category_id'],
            phone: $data['phone'],
            password: bcrypt($data['password']) ?: null,
            password_confirmation: $data['password_confirmation'] ?? null,
            roles: $data['roles'],
        );
    }
}

