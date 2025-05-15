@if (auth()->user()->canany(arrayValueRecursive('permission', $menu['submenu'])))
<li x-data="accordionItem('{{ $keyMenu }}')">
    <a
        :class="expanded ? 'text-slate-800 font-semibold dark:text-navy-50' : 'text-slate-600 dark:text-navy-200'"
        @click="expanded = !expanded"
        class="flex items-center justify-between py-2 p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:hover:text-navy-50"
        href="javascript:void(0);"
    >
        <div class="flex items-center space-x-2">
            @isset($menu['svg'])
                <x-sidebar.menu-icon :path="$menu['svg']" />
            @endisset
            <span>{{ $menu['title'] }}</span>
        </div>
        <x-sidebar.chevron-icon />
    </a>

    <ul x-collapse x-show="expanded" class="px-6">
        @foreach ($menu['submenu'] as $keyMenu => $submenu)
            @if (auth()->user()->can($submenu['permission']) || !$submenu['permission'])
                <x-sidebar.submenu-child-item
                    :submenu="$submenu"
                    :pageName="$pageName"
                />
            @endif
        @endforeach
    </ul>
</li>
@endif
