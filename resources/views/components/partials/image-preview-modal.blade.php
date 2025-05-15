<x-partials.modal class="max-w-lg" modal-key="show-image">
    <div>
        <div class="mb-4 text-right" style="margin-top: -25px;">
            <button
                @click="showModal = !showModal"
                class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4.5 w-4.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                    ></path>
                </svg>
            </button>
        </div>
        <img class="h-full w-full shrink-0 rounded-t-lg bg-cover bg-center object-cover object-center lg:h-auto lg:w-auto lg:rounded-t-none lg:rounded-l-lg" src="{{ $src }}" alt="image">
    </div>
</x-partials.modal>
