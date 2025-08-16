<svg
    xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    class="h-6 w-6"
>

    @if (is_array($path))
        @foreach ($path as $p)
            {!! $p !!}
        @endforeach
    @else
        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" />
    @endif
</svg>
