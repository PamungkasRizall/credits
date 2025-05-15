@php
    $model = $attributes->has('wire:model') ? $attributes->get('wire:model') : $attributes->get('wire:model.live');
@endphp

<label class="block">
    @isset($title)
    <span>
        {{ $title }}
        @isset($required)
            <span class="text-tiny+ text-error">*</span>
        @endisset
    </span>
    @endisset

    <div class="inline-space mt-3 @if ($attributes->has('item-bold')) font-semibold @endif">
        @isset($options)
            @foreach($options as $k => $val)
                <label class="inline-flex items-center space-x-2">
                    <input
                        {{
                            $attributes->merge([
                                'class' => 'form-radio is-outline h-5 w-5 rounded-full border-slate-400/70 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent',
                                'value' => $k,
                                'name' => $model,
                                'type' => 'radio'
                            ])
                        }}
                    />
                    <p>{{ $val }}</p>
                </label>
            @endforeach
        @endisset
    </div>

    @error($model)
        <span class="text-tiny+ text-error">
            {{ $message }}
        </span>
    @enderror

</label>
