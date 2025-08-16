@if (auth()->user()->canany(arrayValueRecursive('permission', $menu['submenu'])))

<div
    x-data="usePopper({placement:'bottom-start',offset:4})"
    @click.outside="isShowPopper && (isShowPopper = false)"
    class="inline-flex"
>
    <button
        x-ref="popperRef" @click="isShowPopper = !isShowPopper"
        class="btn space-x-2 px-2 py-1.5 text-xs+ font-medium leading-none"
        :class="isShowPopper ? 'bg-slate-150 text-slate-800 dark:bg-navy-500 dark:text-navy-100' : 'text-slate-600 hover:text-slate-800 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25'">

        @isset($menu['svg'])
            <x-sidebar.menu-icon-horizontal
                :path="$menu['svg']"
            />
        @endisset
        <span>{{ $menu['title'] }}</span>

    </button>
    <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
        <div
            class="popper-box max-h-[calc(100vh-120px)] overflow-y-auto rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">

            @foreach ($menu['submenu'] as $keyMenu => $submenu)
                @if (auth()->user()->can($submenu['permission']) || !$submenu['permission'])
                    <li>
                        <a href="{{ route($submenu['route_name']) }}"
                            class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100
                            {{ (childrenMenuActive($submenu['route_name']) === childrenMenuActive($pageName) || (isset($submenu['active_bar']) && in_array($pageName, $submenu['active_bar'])))
                                ? 'text-primary dark:text-accent-light font-medium'
                                : ''
                            }}">
                            {{ $submenu['title'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endif
