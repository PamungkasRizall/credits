<div class="board-draggable relative flex max-h-full w-72 shrink-0 flex-col">
    <div class="board-draggable-handler flex items-center justify-between px-0.5 pb-3">
        <div class="flex items-center space-x-2">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-{{ $attributesStatus[1] }}/10 text-{{ $attributesStatus[1] }}">
                <i class="{{ $attributesStatus[2] }} text-base"></i>
            </div>
            <h3 class="text-base text-slate-700 dark:text-navy-100">
                {{ $attributesStatus[0] }}
            </h3>
        </div>
    </div>

    @include('livewire.be.course.partials.card')

</div>
