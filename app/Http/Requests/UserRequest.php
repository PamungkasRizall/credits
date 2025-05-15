<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'name' => '',
        'username' => '',
        'phone' => '',
        'password' => '',
        'category_id' => 0,
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
            'category_id' => [
                'required',
            ],
            'username' => [
                'required',
                'min:3',
                'max:100',
                'unique:users,username,'.$model_id
            ],
            'phone' => $this->getPhoneRules($model_id),
            'password' => [
                'required_without:model_id',
                'sometimes',
                'confirmed',
                'min:6'
            ],
            'roles' => [
                'required',
                'array'
            ]
        ];
    }

    private function getPhoneRules(?string $model_id = null): array
    {
        return [
            'required',
            'max:15',
            'unique:users,phone,'.$model_id,
            'regex:/^([0-9\s\-\+\(\)]*)$/',
            function ($attribute, $value, $fail) {
                if (!str_starts_with($value, '628')) {
                    $fail('Format nomor telepon tidak valid');
                }
            }
        ];
    }

}

