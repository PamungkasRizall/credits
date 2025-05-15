@if (auth()->user()->can($menu['permission']))
<li @if ($menu['route_name'] === $pageName) x-init="$el.scrollIntoView({block:'center'});" @endif>
    <a
        href="{{ route($menu['route_name']) }}"
        class="group flex justify-between space-x-2 rounded-lg p-2 tracking-wide outline-none transition-all {{ $menu['route_name'] === $pageName || (childrenMenuActive($menu['route_name']) === childrenMenuActive($pageName))
            ? 'text-primary dark:bg-accent-light/10 dark:text-accent-light bg-primary/10'
            : 'text-slate-600 hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-200 dark:hover:bg-navy-600 dark:focus:bg-navy-600' }}"
    >
        <div class="flex items-center space-x-2">
            @isset($menu['svg'])
                <x-sidebar.menu-icon
                    :path="$menu['svg']"
                    :active="$menu['route_name'] === $pageName"
                />
            @endisset
            <span>{{ $menu['title'] }}</span>
        </div>
    </a>
</li>
@endif
