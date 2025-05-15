@aware(['component', 'tableName'])
<div @class([
        'ml-0 ml-md-2' => $component->isBootstrap4(),
        'ms-0 ms-md-2' => $component->isBootstrap5(),
    ])
>
    <select
        wire:model.live="perPage" id="{{ $tableName }}-perPage"

        @class([
                'form-control' => $component->isBootstrap4(),
                'form-select' => $component->isBootstrap5(),
                'form-select mt-2 h-8 w-full rounded-lg border border-slate-300 bg-white pr-6 pl-2 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent' => $component->isTailwind(),
            ])
    >
        @foreach ($component->getPerPageAccepted() as $item)
            <option
                value="{{ $item }}"
                wire:key="{{ $tableName }}-per-page-{{ $item }}"
            >
                {{ $item === -1 ? __('All') : $item }}
            </option>
        @endforeach
    </select>
</div>
