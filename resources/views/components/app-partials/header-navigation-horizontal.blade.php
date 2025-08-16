<div class="is-scrollbar-hidden -mx-2 hidden h-12 items-center space-x-2 overflow-y-auto font-inter sm:flex">
    @foreach ($sidebarMenu['items'] as $key => $menuItems)
        @foreach ($menuItems as $keyMenu => $menu)
            @if (isset($menu['submenu']))
                <x-sidebar.submenu-item-horizontal
                    :menu="$menu"
                    :keyMenu="$keyMenu"
                    :pageName="$pageName"
                />
            @else
                <x-sidebar.menu-item-horizontal
                    :menu="$menu"
                    :pageName="$pageName"
                />
            @endif
        @endforeach
    @endforeach
</div>
