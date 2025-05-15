@aware(['component', 'row', 'rowIndex', 'tableName'])
@props(['column', 'colIndex'])

@php
    $customAttributes = $component->getTdAttributes($column, $row, $colIndex, $rowIndex)
@endphp

<td wire:key="{{ $tableName . '-table-td-'.$row->{$this->getPrimaryKey()}.'-'.$column->getSlug() }}"
    @if ($column->isClickable())
        @if($component->getTableRowUrlTarget($row) === "navigate") wire:navigate href="{{ $component->getTableRowUrl($row) }}"
        @else onclick="window.open('{{ $component->getTableRowUrl($row) }}', '{{ $component->getTableRowUrlTarget($row) ?? '_self' }}')"
        @endif
    @endif
        {{
            $attributes->merge($customAttributes)
                ->class(['whitespace-nowrap px-4 py-3 sm:px-5' => $component->isTailwind() && ($customAttributes['default'] ?? true)])
                ->class(['hidden' =>  $component->isTailwind() && $column && $column->shouldCollapseAlways()])
                ->class(['hidden sm:table-cell' => $component->isTailwind() && $column && $column->shouldCollapseOnMobile()])
                ->class(['hidden md:table-cell' => $component->isTailwind() && $column && $column->shouldCollapseOnTablet()])
                ->except('default')
        }}
    >
        {{ $slot }}
</td>
