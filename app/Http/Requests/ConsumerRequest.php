<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConsumerRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'name' => '',
        'nik' => 0,
        // 'date_of_birth' => Carbon::now(),
        'phone' => 0,
        'home_address' => '',
        'business_type' => '',
        'business_address' => '',
        'business_status' => '',
        'sub_district_code' => 0,
        'radius' => 0,
        'companion' => [],
    ];

    public function rules(?string $model_id = null): array
    {
        return [
            'model_id' => [
                'nullable'
            ],
            'name' => [
                'required',
                'min:3'
            ],
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                'unique:consumers,nik,'.$model_id
            ],
            'date_of_birth' => [
                'required',
                'date'
            ],
            'gender' => [
                Rule::enum(Gender::class)
            ],
            'phone' => $this->getPhoneRules($model_id),
            'home_address' => [
                'required'
            ],
            'business_type' => [
                'required'
            ],
            'business_address' => [
                'required'
            ],
            'business_status' => [
                'required'
            ],
            'sub_district_code' => [
                'required',
                'integer'
            ],
            'radius' => [
                'required',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],

            'companion' => [
                'required',
                'array'
            ],
            'companion.name' => ['required'],
            'companion.address' => ['required'],
            'companion.profession' => ['required'],
            'companion.phone' => ['required', 'numeric'],
            'companion.relationship_id' => ['required'],
        ];
    }

    private function getPhoneRules(?string $model_id = null): array
    {
        return [
            'required',
            'max:15',
            'unique:consumers,phone,'.$model_id,
            'regex:/^([0-9\s\-\+\(\)]*)$/',
            function ($attribute, $value, $fail) {
                if (!str_starts_with($value, '628')) {
                    $fail('Format nomor telepon tidak valid');
                }
            }
        ];
    }

}

