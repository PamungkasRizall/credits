<div class="inline-space mt-1.5">
    @isset($options)
        @foreach($options as $k => $val)
            <label class="inline-flex items-center space-x-2">
                <input
                    wire:model="{{ $model }}"
                    value="{{ $k }}"
                    name="{{ $name }}"
                    class="form-radio is-outline h-5 w-5 rounded-full border-slate-400/70 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                    type="radio"
                />
                <p>{{ $val }}</p>
            </label>
        @endforeach
    @endisset
</div>