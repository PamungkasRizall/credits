@if (auth()->user()->can($menu['permission']))
<a href="{{ route($menu['route_name']) }}" class="btn space-x-2 px-2 py-1.5 text-xs+ font-medium leading-none {{ $menu['route_name'] === $pageName || (childrenMenuActive($menu['route_name']) === childrenMenuActive($pageName))
    ? 'bg-primary/10 text-primary dark:bg-accent-light/10 dark:text-accent-light'
    : 'text-slate-600 hover:text-slate-800 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25' }}
    ">
    @isset($menu['svg'])
        <x-sidebar.menu-icon-horizontal :path="$menu['svg']" :active="$menu['route_name'] === $pageName" />
    @endisset
    <span>{{ $menu['title'] }}</span>
</a>
@endif
