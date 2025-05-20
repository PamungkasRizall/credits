<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'name' => '',
        'notes' => '',
        'merk_id' => 0,
        'type' => '',
        'unit_id' => 0,
        'hpp' => '',
        'price' => '',
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
            'merk_id' => [
                'required',
            ],
            'type' => [
                'required',
            ],
            'unit_id' => [
                'required',
            ],
            'hpp' => [
                'required',
            ],
            'price' => [
                'required',
            ],
            'notes' => [
                'nullable',
            ]
        ];
    }
}

