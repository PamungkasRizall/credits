<svg
    xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke-width="1.5"
    stroke="currentColor"
    class="h-4.5 w-4.5 {{ isset($active) && $active ? '' : 'text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200' }}"
>
    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" />
</svg> 
