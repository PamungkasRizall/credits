@aware(['component', 'tableName'])

@php
    $customAttributes = [
        'wrapper' => $this->getTableWrapperAttributes(),
        'table' => $this->getTableAttributes(),
        'thead' => $this->getTheadAttributes(),
        'tbody' => $this->getTbodyAttributes(),
    ];
@endphp

<div
    wire:key="{{ $tableName }}-twrap"
    {{ $attributes->merge($customAttributes['wrapper'])
        ->class(['is-scrollbar-hidden min-w-full overflow-x-auto' => $customAttributes['wrapper']['default'] ?? true])
        ->except('default') }}
>
    <table
        wire:key="{{ $tableName }}-table"
        {{ $attributes->merge($customAttributes['table'])
            ->class(['is-hoverable w-full text-left' => $customAttributes['table']['default'] ?? true])
            ->except('default') }}
    >
        <thead wire:key="{{ $tableName }}-thead"
            {{ $attributes->merge($customAttributes['thead'])
                ->class(['' => $customAttributes['thead']['default'] ?? true])
                ->except('default') }}
        >
            <tr>
                {{ $thead }}
            </tr>
        </thead>

        <tbody
            wire:key="{{ $tableName }}-tbody"
            id="{{ $tableName }}-tbody"
            {{ $attributes->merge($customAttributes['tbody'])
                    ->class(['bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-none' => $customAttributes['tbody']['default'] ?? true])
                    ->except('default') }}
        >
            {{ $slot }}
        </tbody>

        @if (isset($tfoot))
            <tfoot wire:key="{{ $tableName }}-tfoot">
                {{ $tfoot }}
            </tfoot>
        @endif
    </table>
</div>