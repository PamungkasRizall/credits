@if (count($breadcrumbs))

    {{-- <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div> --}}
    <div class="my-1 hidden w-px self-stretch bg-slate-300 dark:bg-navy-600 sm:flex"></div>

    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!$loop->last)
                <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="{{ $breadcrumb->url ?? 'javascript:;' }}">
                    {{ $breadcrumb->title }}
                </a>
                <svg
                    x-ignore
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                    />
                </svg>
            @else
                <li>{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ul>

@endif