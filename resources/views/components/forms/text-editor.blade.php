<div class="min-w-full {{ $attributes->has('labelClass') ? $attributes->get('labelClass') : '' }}">
    <p>
        @isset($title)
        <span>
            {{ $title }}
            @isset($required)
                <span class="text-tiny+ text-error">*</span>
            @endisset
        </span>
        @endisset
    </p>

    <div class="relative mt-1.5 flex w-full">
        <div class="ql-header-filled w-full" wire:ignore>
            <div
                class="h-48"
                x-init="$el._x_quill = new Quill($el,{
                        modules : {
                        toolbar:
                            @if ($attributes->has('options'))
                                {{ json_encode((object)$attributes->get('options')) }}
                            @else
                            [
                                [{ size: ['small', false, 'large', 'huge'] }], // custom dropdown
                                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                                ['bold', 'italic', 'underline', 'strike', 'blockquote'], // toggled buttons
                                // [{ header: 1 }, { header: 2 }], // custom button values
                                [{ list: 'ordered' }, { list: 'bullet' }],
                                // [{ script: 'sub' }, { script: 'super' }], // superscript/subscript
                                // [{ indent: '-1' }, { indent: '+1' }], // outdent/indent
                                // [{ direction: 'rtl' }], // text direction
                                // [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                                // [{ font: [] }],
                                [{ align: [] }],
                                ['link', 'clean']
                            ],
                            @endif
                        },
                        placeholder: 'Enter your content...',
                        theme: 'snow',
                    }).on('text-change', function () {
                        @if ($attributes->has('dynamically'))
                            let value = document.getElementsByClassName('ql-editor')[{{$attributes->get('dynamically')}}].innerHTML;
                        @else
                            let value = document.getElementsByClassName('ql-editor')[{{ $attributes->has('index') ? $attributes->get('index') : 0 }}].innerHTML;
                        @endif

                        let property = '{{ $attributes->get('wire:model') }}';

                        @this.set(property, value)
                    });"
            >
            @isset($value)
                {!! $value !!}
            @endisset
            </div>
        </div>
    </div>

    @if ($attributes->has('wire:model'))
        @error($attributes->get('wire:model'))
            <span class="text-tiny+ text-error">
                {{ $message }}
            </span>
        @enderror
    @endif

</div>
