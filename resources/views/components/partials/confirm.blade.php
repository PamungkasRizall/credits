<x-partials.modal class="max-w-lg" modal-key="confirm" modal-header="disabled">
    @isset($type)
        @if ($type == 'delete')

        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="inline h-28 w-28 text-error"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
        ></path>
        </svg>

        <div class="mt-4 px-5">
            <h2 class="text-2xl text-slate-700 dark:text-navy-100">
                {{ __('Are You Sure?') }}
            </h2>
            <p class="mt-2">
                {{ __('You won\'t be able to revert this!') }}
            </p>
            <button x-on:click="showModal = false" class="btn mt-6 h-8 text-xs+ font-medium text-slate-700 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25">
                {{ __('No, cancel') }}
            </button>
            <button type="button" wire:click="destroy" class="btn h-8 mt-6 bg-primary text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                {{ __('Yes, delete it!') }}
            </button>
        </div>

        @endif

        @if ($type == 'message-success')
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="inline h-28 w-28 text-success"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                ></path>
            </svg>

            <div class="mt-4">
                <h2 class="text-2xl text-slate-700 dark:text-navy-100">
                    Tes Telah Selesai
                </h2>
                <p class="mt-2">
                    Terima kasih.<br/>
                    Hasil akan segera kami olah, <b>tahapan selanjutnya adalah wawancara.</b> <br/>
                    Informasi jadwalnya akan kami kirim via email / whatsapp.<br/><br/>
                </p>
                <button
                    @click="showModal = false"
                    class="btn mt-6 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90"
                    >
                    Close
                </button>
            </div>
        @endif

        @if ($type == 'confirm')
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="inline h-28 w-28 text-info"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
                ></path>
            </svg>

            <div class="mt-4">
                <h2 class="text-2xl text-slate-700 dark:text-navy-100">
                    {{ $title }}
                </h2>
            </div>

            <div class="space-x-3 mt-4">
                <button
                    @click="showModal = false"
                    class="btn min-w-[7rem] border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                >
                    Cancel
                </button>
                <button
                    wire:click.prevent="{{ $action }}"
                    class="btn min-w-[7rem] bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                >
                    Apply
                </button>
            </div>
        @endif
    @endisset
</x-partials.modal>
