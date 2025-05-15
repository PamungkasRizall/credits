<div class="sidebar-panel">
    <div class="flex h-full grow flex-col bg-white pl-[var(--main-sidebar-width)] dark:bg-navy-750">
        {{-- Header --}}
        <x-sidebar.header :title="$sidebarMenu['title']" />

        {{-- Body --}}
        <div
            class="h-[calc(100%-4.5rem)] overflow-x-hidden pb-6"
            x-data="{ expandedItem: null }"
            x-init="$el._x_simplebar = new SimpleBar($el);"
        >
            @foreach ($sidebarMenu['items'] as $key => $menuItems)
                @if ($key > 0)
                    <x-sidebar.divider />
                @endif

                <ul class="mt-4 space-y-1.5 px-2 font-inter text-xs+ font-medium">
                    @foreach ($menuItems as $keyMenu => $menu)
                        @if (isset($menu['submenu']))
                            <x-sidebar.submenu-item
                                :menu="$menu"
                                :keyMenu="$keyMenu"
                                :pageName="$pageName"
                            />
                        @else
                            <x-sidebar.menu-item
                                :menu="$menu"
                                :pageName="$pageName"
                            />
                        @endif
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</div>
