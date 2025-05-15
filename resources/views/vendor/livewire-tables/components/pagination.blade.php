@aware(['component'])
@props(['rows'])

@if ($component->hasConfigurableAreaFor('before-pagination'))
    @include($component->getConfigurableAreaFor('before-pagination'), $component->getParametersForConfigurableArea('before-pagination'))
@endif

<div style="border-top-color: #e2e8f0; border-top-width: 1px;">
    @if ($component->paginationVisibilityIsEnabled())
        <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
            <div class="text-xs+">
                @if ($component->paginationIsEnabled() && $component->isPaginationMethod('standard') && $rows->lastPage() > 1)
                    {{ $rows->firstItem() }} 
                    @lang('-') 
                    {{ $rows->lastItem() }} 
                    @lang('of') 
                    {{ $rows->total() }}
                    @lang('results')
                @elseif ($component->paginationIsEnabled() && $component->isPaginationMethod('simple'))
                    @lang('Showing') 
                    {{ $rows->firstItem() }} 
                    @lang('to') 
                    {{ $rows->lastItem() }}
                @elseif ($component->paginationIsEnabled() && $component->isPaginationMethod('cursor'))
                @else
                    @lang('Showing') 
                    {{ $rows->count() }} 
                    @lang('results')
                @endif
            </div>

            @if ($component->paginationIsEnabled())
                {{ $rows->links('livewire-tables::specific.tailwind.'.(!$component->isPaginationMethod('standard') ? 'simple-' : '').'pagination') }}
            @endif
        </div>
    @endif
</div>

@if ($component->hasConfigurableAreaFor('after-pagination'))
    @include($component->getConfigurableAreaFor('after-pagination'), $component->getParametersForConfigurableArea('after-pagination'))
@endif
