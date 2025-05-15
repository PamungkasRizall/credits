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

    <span class="relative mt-1.5 flex -space-x-px">

        @if($attributes->has('addon'))
            <span class="flex items-center justify-center rounded-l-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450">
                <span class="-mt-1">{{ $attributes->get('addon') }}</span>
            </span>
        @endif

        <textarea
            {{
                $attributes->merge([
                    'class' => 'form-textarea w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent',
                    'placeholder' => $attributes->has('placeholder') ? $attributes->get('placeholder') : '',
                    'rows' => $attributes->has('rows') ? $attributes->get('rows') : '4'
                ]);
            }}
        >
        </textarea>
    </span>
        
    @isset($model)
        @error($model)
            <span class="text-tiny+ text-error">
                {{ $message }}
            </span>
        @enderror
    @endisset

</label>