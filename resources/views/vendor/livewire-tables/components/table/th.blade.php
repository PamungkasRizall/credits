@aware(['component', 'tableName'])
@props(['column', 'index', 'last'])

@php
    $attributes = $attributes->merge(['wire:key' => $tableName . '-header-col-'.$column->getSlug()]);
    $customAttributes = $component->getThAttributes($column);
    $customSortButtonAttributes = $component->getThSortButtonAttributes($column);
    $direction = $column->hasField() ? $component->getSort($column->getColumnSelectName()) : $component->getSort($column->getSlug()) ?? null ;
    $rounded = ($index == 0 && !$component->hasBulkActions()) ? 'rounded-tl-lg ' : '';
    $rounded .= ($last) ? 'rounded-tr-lg' : '';
@endphp

<th scope="col" {{
    $attributes->merge($customAttributes)
        ->class(['whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 ' . $rounded => $customAttributes['default'] ?? true])
        ->class(['hidden' => $column->shouldCollapseAlways()])
        ->class(['hidden md:table-cell' => $column->shouldCollapseOnMobile()])
        ->class(['hidden lg:table-cell' => $column->shouldCollapseOnTablet()])
        ->except('default')
    }}
>
    @if($column->getColumnLabelStatus())
        @unless ($component->sortingIsEnabled() && ($column->isSortable() || $column->getSortCallback()))
            {{ $column->getTitle() }}
        @else
            <button
                wire:click="sortBy('{{ ($column->isSortable() ? $column->getColumnSelectName() : $column->getSlug()) }}')"
                {{
                    $attributes->merge($customSortButtonAttributes)
                        ->class(['flex items-center space-x-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider group focus:outline-none dark:text-gray-400' => $customSortButtonAttributes['default'] ?? true])
                        ->except(['default', 'wire:key'])
                }}
            >
                <span class="font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100">{{ $column->getTitle() }}</span>

                <span class="relative flex items-center">
                    @if ($direction === 'asc')
                        <x-heroicon-o-chevron-up class="w-3 h-3 group-hover:opacity-0" />
                        <x-heroicon-o-chevron-down class="w-3 h-3 opacity-0 group-hover:opacity-100 absolute"/>
                    @elseif ($direction === 'desc')
                        <x-heroicon-o-chevron-down class="w-3 h-3 group-hover:opacity-0" />
                        <x-heroicon-o-x-circle class="w-3 h-3 opacity-0 group-hover:opacity-100 absolute"/>
                    @else
                        <x-heroicon-o-chevron-up class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                    @endif
                </span>
            </button>
        @endunless
    @endif
</th>