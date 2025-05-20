@php
    $pl9 = $attributes->has('svgd') ? 'pl-9' : '';
    $bgReadonly = $attributes->has('readonly') ? ' bg-primary/10 ' : ' bg-transparent';
    $model = $attributes->get('wire:model')
        ?? $attributes->get('wire:model.live')
        ?? $attributes->get('wire:model.blur')
        ?? collect($attributes->getAttributes())
            ->first(fn($v, $k) => str_starts_with($k, 'wire:model.debounce'));
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

        <input
            {{
                $attributes->merge([
                    'class' => 'form-input w-full ' . ($attributes->has('addon') ? 'rounded-r-lg' : 'rounded-lg') . ' border border-slate-300 '. $pl9 . $bgReadonly . ' px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600',
                    'placeholder' => $attributes->has('placeholder') ? $attributes->get('placeholder') : '',
                    'type' => $attributes->has('type') ? $attributes->get('type') : 'text'
                ])
            }}
        >

        @if($attributes->has('svgd'))
        <span
            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 transition-colors duration-200"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5"
            >
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="{{ $attributes->get('svgd') }}"
                />
            </svg>
        </span>
        @endisset
    </span>

    @error($model)
        <span class="text-tiny+ text-error">
            {{ $message }}
        </span>
    @enderror

</label>
