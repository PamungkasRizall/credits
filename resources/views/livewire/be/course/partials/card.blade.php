<div
    class="is-scrollbar-hidden relative space-y-2.5 overflow-y-auto p-0.5"
    x-init="Sortable.create($el,{
            animation: 200,
            group:'board-cards',
            easing: 'cubic-bezier(0, 0, 0.2, 1)',
            direction: 'vertical',
            delay: 150,
            delayOnTouchOnly: true,
        })"
>

    @forelse ($courses as $course)

        <div class="flex flex-col">
            <img
                class="h-44 w-full rounded-2xl object-cover object-center"
                src="{{ $course->image }}"
                alt="image"
                />
            <div class="card -mt-8 grow rounded-2xl p-4">
                <div>
                    <a
                        href="#"
                        class="text-sm+ font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                        {{ $course->title }}
                    </a>
                </div>
                <div class="flex flex-wrap space-x-1 py-2">
                    <div
                      class="badge space-x-1 bg-slate-150 py-1 px-1.5 text-slate-800 dark:bg-navy-500 dark:text-navy-100"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-3.5 w-3.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                        />
                      </svg>
                      <span> {{ dateFormatLocale($course->start_at, 'd F') }}</span>
                    </div>
                    <div class="badge bg-primary/10 py-1 px-1.5 text-primary dark:bg-primary/15">
                        {{ $course->type->name }}
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <a
                        href="#"
                        class="flex items-center space-x-2 text-xs hover:text-slate-800 dark:hover:text-navy-100"
                    >
                        <div class="avatar h-6 w-6">
                            <img
                            class="rounded-full"
                            src="{{ asset('images/users/male.png') }}"
                            alt="avatar"
                            />
                        </div>
                        <span class="line-clamp-1">{{ $course->user->name }}</span>
                    </a>
                    <p class="flex shrink-0 items-center space-x-1.5 text-slate-400 dark:text-navy-300">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                        <span class="text-xs">25 May, 2022</span>
                    </p>
                </div>
            </div>
        </div>

    @empty
        <div class="w-72 shrink-0">
            <button class="btn w-full bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                Tidak Ada Data
            </button>
        </div>
    @endforelse

</div>
