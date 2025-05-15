<label class="block">
    <span>
        {{ $title }} @if($required)<span class="text-tiny+ text-error">*</span>@endif
    </span>
    <span class="relative flex -space-x-px">
        <x-forms.filepond
            wire:model="{{ $attributes->get('wire:model') }}"
            class="{{ $attributes->get('class') }}"
            labelClass="mt-0"
            allowImagePreview
            allowFileTypeValidation
            {...$config}
        />
    </span>
    @error($attributes->wire('model')->value())
        <span class="text-tiny+ text-error">{{ $message }}</span>
    @enderror
</label>
