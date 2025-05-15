@php
    $model = $attributes->has('wire:model') ? $attributes->get('wire:model') : $attributes->get('wire:model.live');
@endphp

<label class="block {{ $attributes->has('labelClass') ? $attributes->get('labelClass') : '' }}">
    @isset($title)
    <span>
        {{ $title }}
        @isset($required)
            <span class="text-tiny+ text-error">*</span>
        @endisset
    </span>
    @endisset

    <input
        {{ $attributes }}
        class="mt-1.5 w-full"
        x-init="$el._tom = new Tom($el,{create:true,plugins: ['caret_position','input_autogrow']})"
        type="text"
    />

    @error($model)
        <span class="text-tiny+ text-error">
            {{ $message }}
        </span>
    @enderror

</label>
