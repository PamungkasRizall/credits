<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />

        <x-forms.button-add-new wire:click="showForm" />
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <livewire:tables.receivables-registration-table />
    </div>

    {{-- Form Modal --}}
    <x-partials.modal-second class="max-w-6xl"
        :head-name="($model_id ? 'Edit' : 'Tambah') . ' ' . Str::singular($meta_title)">
        <div class="m-3 grid grid-cols-12 gap-2 sm:gap-3 lg:gap-4">
            <div class="col-span-12 lg:col-span-6">
                @include('livewire.receivables-registration.form')
            </div>

            <div class="col-span-12 lg:col-span-6">
                @if ($consumer)
                @include('livewire.master.consumers.detail')
                @endif

                @if ($product)
                @include('livewire.master.products.detail')
                @endif
            </div>
        </div>
    </x-partials.modal-second>


    {{-- Utility Modals --}}
    <x-partials.confirm type="delete" />

    <x-partials.modal head-name="Konsumen" class="max-w-6xl" modal-key="consumer">
        <div class="p-5 overflow-y-auto">
            {{-- <livewire:tables.consumers-table modal=true wire:key="consumer"> --}}
                <livewire:master.consumers modal=true>
        </div>
    </x-partials.modal>

    <x-partials.modal head-name="Produk" class="max-w-screen-lg max-h-full" modal-key="product">
        <div class="p-5 overflow-y-auto">
            <livewire:tables.products-table modal=true wire:key="product">
        </div>
    </x-partials.modal>

    {{-- Show Modal Detail --}}
    <x-partials.modal class="max-w-6xl" head-name="Konfirmasi Pengiriman Barang">
        <div class="m-3 grid grid-cols-12 gap-2 sm:gap-3 lg:gap-4 is-scrollbar overflow-y-auto">
            <div class="col-span-12 lg:col-span-6">
                @if ($model_id && $receivablesRegistration)
                @include('livewire.receivables-registration.detail')

                @if ($receivablesRegistration->status == \App\Enums\ReceivablesRegistrationStatus::PENDING)
                @include('livewire.receivables-registration.form-status')
                @endif

                @if ($receivablesRegistration->status == \App\Enums\ReceivablesRegistrationStatus::IN_PROCESS)
                @include('livewire.receivables-registration.form-angsuran')
                @endif

                @endif
            </div>

            <div class="col-span-12 lg:col-span-6">
                @if ($consumer)
                @include('livewire.master.consumers.detail')
                @endif

                @if ($product)
                @include('livewire.master.products.detail')
                @endif

                @if ($model_id && $receivablesRegistration)
                @if ($receivablesRegistration->status == \App\Enums\ReceivablesRegistrationStatus::IN_PROCESS)
                <a href="{{ route('registration.receivables-registration.print-invoice', ['id' => $receivablesRegistration->id]) }}"
                    target="_blank"
                    class="btn h-8 space-x-2 font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mt-px h-4.5 w-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z">
                        </path>
                    </svg>
                    <span>Faktur Sewa Beli</span>
                </a>

                <a href="{{ route('registration.receivables-registration.print-angsuran-coupon', ['id' => $receivablesRegistration->id]) }}"
                    target="_blank"
                    class="btn h-8 space-x-2 font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mt-px h-4.5 w-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z">
                        </path>
                    </svg>
                    <span>Kupon Angsuran</span>
                </a>

                <a href="{{ route('registration.receivables-registration.print-angsuran-card', ['id' => $receivablesRegistration->id]) }}"
                    target="_blank"
                    class="btn h-8 space-x-2 font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mt-px h-4.5 w-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z">
                        </path>
                    </svg>
                    <span>Kartu Piutang</span>
                </a>
                @endif
                @endif
            </div>
        </div>
    </x-partials.modal>

</main>