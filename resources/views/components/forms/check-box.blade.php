@isset($options)
          
    @foreach($options as $k => $val)
        <label class="inline-flex items-center space-x-2 {{ $attributes->has('labelClass') ? $attributes->get('labelClass') : '' }}">
            <input
                class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-primary-light dark:checked:border-primary-light dark:hover:border-primary-light dark:focus:border-primary-light"
                type="checkbox"
                wire:model="{{ $model }}"
                value="{{ $k }}"
            />
            <p>{{ $val }}</p>
        </label>
    @endforeach

@endisset