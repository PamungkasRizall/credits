<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceivablesRegistrationRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'consumer_id' => '',
        'product_id' => '',
        'tenor' => 0,
        'bill_per_day' => '',
        'total' => '',
        'down_payment' => '',
        'sales_id' => '',
        'supervisor_id' => '',
        'wasdit_id' => '',
        'ar_id' => '',
        'collector_id' => '',
    ];

    public function rules(?string $model_id = null): array
    {
        return [
            'model_id' => [
                'nullable'
            ],
            'tenor' => [
                'required',
            ],
            'consumerDesc' => [
                'required',
            ],
            'consumer_id' => [
                'required',
            ],
            'productDesc' => [
                'required',
            ],
            'product_id' => [
                'required',
            ],
            'item_price' => [
                'required',
            ],
            'bill_per_day' => [
                'required',
            ],
            'total' => [
                'required',
            ],
            'down_payment' => [
                'required',
            ],
            'date_at' => [
                'required',
            ],
            'sales_id' => [
                'required',
            ],
            'supervisor_id' => [
                'required',
            ],
            'wasdit_id' => [
                'required',
            ],
            'ar_id' => [
                'required',
            ],
            'collector_id' => [
                'required',
            ]
        ];
    }

    public function rulesStatus(): array
    {
        return [
            'model_id' => [
                'required'
            ],
            'status' => [
                'required',
            ],
            'tenor' => [
                'required',
            ],
            'date_at_installment' => [
                'required',
            ],
            'awd' => [
                'required',
                'array'
            ]
        ];
    }

    public function rulesAngsuran(): array
    {
        return [
            'model_id' => [
                'required'
            ],
            'angsuran' => [
                'required',
                'array'
            ]
        ];
    }
}

