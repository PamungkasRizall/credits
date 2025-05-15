@aware(['component', 'tableName'])

<div x-cloak x-show="!currentlyReorderingStatus"
    style="margin-left: unset;"
    @class([
        'mb-3 mb-md-0 input-group' => $component->isBootstrap(),
        'flex rounded-md shadow-sm pt-2' => $component->isTailwind(),
    ])>
        <input
            wire:model{{ $component->getSearchOptions() }}="search"
            placeholder="{{ $component->getSearchPlaceholder() }}"
            type="text"
            {{ 
                $attributes->merge($component->getSearchFieldAttributes())
                ->class([
                    'form-input h-8 w-full rounded-lg border border-slate-300 bg-transparent px-4 py-2 text-xs+ placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent rounded-none rounded-l-md focus:ring-0 focus:border-gray-300' => $component->isTailwind() && $component->hasSearch() && $component->getSearchFieldAttributes()['default'] ?? true,
                    'form-input h-8 w-full rounded-lg border border-slate-300 bg-transparent px-4 py-2 text-xs+ placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent' => $component->isTailwind() && !$component->hasSearch() && $component->getSearchFieldAttributes()['default'] ?? true,
                    'form-control' => $component->isBootstrap() && $component->getSearchFieldAttributes()['default'] ?? true,
                ])
                ->except('default') 
            }}

        />

        @if ($component->hasSearch())
        <div @class([
                    'd-inline-flex h-100 align-items-center ' => $component->isBootstrap(),
                ])>
                <div
                    wire:click="clearSearch"

                    @class([
                            'btn btn-outline-secondary d-inline-flex h-100 align-items-center' => $component->isBootstrap(),
                            'inline-flex h-full items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $component->isTailwind(),
                        ])
                >
                @if($component->isTailwind())
                <x-heroicon-m-x-mark class='w-4 h-4' />
                @else
                <x-heroicon-m-x-mark style='width:1em; height:1em;'  />
                @endif
                    </div>
            </div>
        @endif


</div>
