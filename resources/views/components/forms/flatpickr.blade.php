@php
    $flatpickrOptions = $options ?? collect([]);
    $flatpickrOptions = array_merge([
                        'dateFormat' => 'Y-m-d',
                        'enableTime' => false,
                        'altFormat' =>  'j F Y',
                        'altInput' => true
                    ], $flatpickrOptions->toArray());
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

    <div wire:ignore class="relative mt-1.5 flex w-full">
        <input
            x-data="{ value : @entangle($attributes->wire('model')) }"
            x-on:change="value = $event.target.value"
            x-init="$el._x_flatpickr = flatpickr($el,{{ json_encode((object)$flatpickrOptions) }})"
            {{ $attributes->whereDoesntStartWith('wire:model') }}
            x-ref="input"
            x-bind:value="value"
            type="text"
            required
            class="form-input w-full rounded-lg border border-slate-300 pl-9 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600"
        />

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
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                />
            </svg>
        </span>
    </div>

    @if ($attributes->has('wire:model'))
        @error($attributes->get('wire:model'))
            <span class="text-tiny+ text-error">
                {{ $message }}
            </span>
        @enderror
    @endif

</label>
