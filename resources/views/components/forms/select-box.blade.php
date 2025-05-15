@php
    $placeholder = $placeholder ?? ($attributes->has('autocomplete') ? 'Search...' : 'Select...');
    $disablePlaceholder = $disablePlaceholder ?? false;
    $multiple = $multiple ?? '';
    $class = $attributes->has('basic') ? "w-full form-select rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent" : "w-full";
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

    <span class="relative mt-1.5 flex w-full">
        <select
            {{
                $attributes->merge([
                    'class' => $class,
                    'autocomplete' => 'off',
                    $multiple
                ])
            }}

            @if ($attributes->has('multiple'))
                x-init="$el._tom = new Tom($el)"
            @elseif($attributes->has('autocomplete'))
                x-init="$el._tom = new Tom($el,
                    {
                        create: false,
                        sortField: {field: 'text', direction: 'asc'},
                        valueField: 'id',
                        labelField: 'title',
                        searchField: 'title',
                        onChange: function(value) {
                            console.log(value);
                        },
                        load: function(query, callback) {

                            var url = '{{ route('search', $attributes->get('autocomplete')) }}' + '?q=' + query;
                            fetch(url, {
                                    method: 'GET',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(json => {
                                    callback(json);
                                }).catch(()=>{
                                    callback();
                                });

                        },
                    })"
            @elseif($attributes->has('basic'))
            @else
                x-init="$el._tom = new Tom($el,{create: false,sortField: {field: 'text',direction: 'asc'}})"
            @endif
        >
            @if(!$disablePlaceholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @isset($options)

                @foreach($options as $k => $val)
                    @if ($attributes->has('sameValue'))
                        <option value="{{ isset($replaceValue) ? str_replace(' ', '-', $val) : $val }}">{{ $val }}</option>
                    @else
                        <option value="{{ isset($replaceValue) ? str_replace(' ', '-', $k) : $k }}">{{ $val }}</option>
                    @endif
                @endforeach

            @endisset
        </select>
    </span>

    @error($model)
        <span class="text-tiny+ text-error">
            {{ $message }}
        </span>
    @enderror

</label>
