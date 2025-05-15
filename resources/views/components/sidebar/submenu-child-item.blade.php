<li @if (childrenMenuActive($submenu['route_name']) === childrenMenuActive($pageName) || (isset($submenu['active_bar']) && in_array($pageName, $submenu['active_bar'])))
    x-init="$el.scrollIntoView({block:'center'}); expanded = true"
    @endif
>
    <a
        href="{{ route($submenu['route_name']) }}"
        class="flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4
        {{ (childrenMenuActive($submenu['route_name']) === childrenMenuActive($pageName) || (isset($submenu['active_bar']) && in_array($pageName, $submenu['active_bar'])))
            ? 'text-primary dark:text-accent-light font-medium'
            : 'text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50' }}"
    >
        <div class="flex items-center space-x-2">
            <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40"></div>
            <span>{{ $submenu['title'] }}</span>
        </div>
    </a>
</li>
