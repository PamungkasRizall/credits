<?php

namespace App\DTOs;

use App\Enums\Gender;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;

class ConsumerDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $name,
        public readonly string $nik,
        public readonly Carbon $date_of_birth,
        public readonly bool $gender,
        public readonly string $phone,
        public readonly string $home_address,
        public readonly string $business_type,
        public readonly string $business_address,
        public readonly string $business_status,
        public readonly int $sub_district_code,
        public readonly float $radius,

        public readonly array $companion,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            name: $data['name'],
            nik: $data['nik'],
            date_of_birth: $data['date_of_birth'],
            gender: $data['gender'],
            phone: $data['phone'],
            home_address: $data['home_address'],
            business_type: $data['business_type'],
            business_address: $data['business_address'],
            business_status: $data['business_status'],
            sub_district_code: $data['sub_district_code'],
            radius: $data['radius'],

            companion: $data['companion'],
        );
    }
}

