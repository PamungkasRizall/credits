<div>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isBootstrap4 :$isBootstrap5 :$isBootstrap />

    <div @class([
        "rounded-md shadow-sm" => $isTailwind,
        "mb-3 mb-md-0 input-group" => $isBootstrap,
    ])>
        <input
            wire:model.blur="filterComponents.{{ $filter->getKey() }}"
            wire:key="{{ $filter->generateWireKey($tableName, 'text') }}"
            id="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif"
            type="text"
            @if($filter->hasConfig('placeholder')) placeholder="{{ $filter->getConfig('placeholder') }}" @endif
            @if($filter->hasConfig('maxlength')) maxlength="{{ $filter->getConfig('maxlength') }}" @endif
            @class([
                "form-input h-8 w-full rounded-lg border border-slate-300 px-2 py-2 text-xs+ placeholder:text-slate-400/70 hover:border-slate-400 dark:text-white dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" => $isTailwind,
                "form-control" => $isBootstrap,
            ])
        />
    </div>
</div>