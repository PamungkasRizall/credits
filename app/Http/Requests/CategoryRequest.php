<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'name' => '',
        'type' => '',
    ];

    public function rules(?string $model_id = null): array
    {
        return [
            'model_id' => [
                'nullable'
            ],
            'name' => [
                'required',
                'min:2'
            ],
            'type' => [
                'required',
            ],
        ];
    }
}

