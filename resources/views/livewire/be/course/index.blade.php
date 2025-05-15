<main class="main-content kanban-app w-full">
    <div class="flex items-center justify-between space-x-2 px-[var(--margin-x)] py-5 transition-all duration-[.25s]">
        <div class="flex items-center space-x-1">
            <h3 class="text-lg font-medium text-slate-700 line-clamp-1 dark:text-navy-50">
                {{ $meta_title }}
            </h3>
        </div>
        <label class="relative hidden w-full max-w-[16rem] sm:flex">
            <input
                class="form-input peer h-8 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 text-xs+ placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                placeholder="Search on boards"
                type="text"
            />
            <span class="pointer-events-none absolute flex h-full w-9 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-colors duration-200"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                    d="M3.316 13.781l.73-.171-.73.171zm0-5.457l.73.171-.73-.171zm15.473 0l.73-.171-.73.171zm0 5.457l.73.171-.73-.171zm-5.008 5.008l-.171-.73.171.73zm-5.457 0l-.171.73.171-.73zm0-15.473l-.171-.73.171.73zm5.457 0l.171-.73-.171.73zM20.47 21.53a.75.75 0 101.06-1.06l-1.06 1.06zM4.046 13.61a11.198 11.198 0 010-5.115l-1.46-.342a12.698 12.698 0 000 5.8l1.46-.343zm14.013-5.115a11.196 11.196 0 010 5.115l1.46.342a12.698 12.698 0 000-5.8l-1.46.343zm-4.45 9.564a11.196 11.196 0 01-5.114 0l-.342 1.46c1.907.448 3.892.448 5.8 0l-.343-1.46zM8.496 4.046a11.198 11.198 0 015.115 0l.342-1.46a12.698 12.698 0 00-5.8 0l.343 1.46zm0 14.013a5.97 5.97 0 01-4.45-4.45l-1.46.343a7.47 7.47 0 005.568 5.568l.342-1.46zm5.457 1.46a7.47 7.47 0 005.568-5.567l-1.46-.342a5.97 5.97 0 01-4.45 4.45l.342 1.46zM13.61 4.046a5.97 5.97 0 014.45 4.45l1.46-.343a7.47 7.47 0 00-5.568-5.567l-.342 1.46zm-5.457-1.46a7.47 7.47 0 00-5.567 5.567l1.46.342a5.97 5.97 0 014.45-4.45l-.343-1.46zm8.652 15.28l3.665 3.664 1.06-1.06-3.665-3.665-1.06 1.06z"
                    />
                </svg>
            </span>
        </label>
        <div class="flex space-x-1">
            <x-forms.button-add-new wire:click="create" />
        </div>
    </div>

    <div class="flex h-[calc(100vh-8.5rem)] flex-grow flex-col">
        <div
            x-init="Sortable.create($el,{
                animation: 200,
                easing: 'cubic-bezier(0, 0, 0.2, 1)',
                delay: 150,
                delayOnTouchOnly: true,
                draggable: '.board-draggable',
                handle: '.board-draggable-handler'
            })"
            class="kanban-scrollbar flex w-full items-start space-x-4 overflow-x-auto overflow-y-hidden px-[var(--margin-x)] transition-all duration-[.25s]"
        >

        <livewire:be.course.kanban :courseStatus="\App\Enums\CourseStatusEnum::DRAFT">

        <livewire:be.course.kanban :courseStatus="\App\Enums\CourseStatusEnum::DPW">

        <livewire:be.course.kanban :courseStatus="\App\Enums\CourseStatusEnum::DPP">

        <livewire:be.course.kanban :courseStatus="\App\Enums\CourseStatusEnum::SIAKPEL">

        <livewire:be.course.kanban :courseStatus="\App\Enums\CourseStatusEnum::MODULE">

        <livewire:be.course.kanban :courseStatus="\App\Enums\CourseStatusEnum::LMS">

        <livewire:be.course.kanban :courseStatus="\App\Enums\CourseStatusEnum::DONE">

        </div>
    </div>
</main>
