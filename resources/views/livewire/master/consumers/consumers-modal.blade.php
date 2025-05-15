<div x-data="{activeTab:'tabList'}" class="tabs flex flex-col">
    <div class="is-scrollbar-hidden overflow-x-auto">
        <div class="border-b-2 border-slate-150 dark:border-navy-500">
            <div class="tabs-list -mb-0.5 flex">
                <button
                    @click="activeTab = 'tabList'"
                    :class="activeTab === 'tabList' ? 'border-primary dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-px h-4.5 w-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                    <span>List</span>
                </button>
                <button
                    @click="activeTab = 'tabForm'"
                    :class="activeTab === 'tabForm' ? 'border-primary dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-px h-4.5 w-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>Tambah Baru</span>
                </button>
            </div>
        </div>
    </div>
    <div class="tab-content pt-4">
        <div
            x-show="activeTab === 'tabList'"
            x-transition:enter="transition-all duration-500 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">

            <livewire:tables.consumers-table modal=true wire:key="consumer">
        </div>
        <div
            x-show="activeTab === 'tabForm'"
            x-transition:enter="transition-all duration-500 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">

            @include('livewire.master.consumers.form')

            {{-- <div class="space-y-4">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                    <x-forms.input
                        wire:model="name"
                        title="Nama Perusahaan"
                        labelClass="sm:col-span-6"
                        required/>

                    <x-forms.input
                        wire:model="director_name"
                        title="Nama yg Menyerahkan"
                        labelClass="sm:col-span-3"
                        required/>

                    <x-forms.input
                        wire:model="position"
                        title="Jabatan"
                        labelClass="sm:col-span-3"
                        required/>
                </div>

                <x-forms.input wire:model="address" placeholder="" title="Alamat Perusahaan" required />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                    <x-forms.input
                        wire:model="bank_name"
                        title="Nama Bank & Cabang"
                        required/>

                    <x-forms.input
                        wire:model="account_number"
                        title="No Rekening"
                        required/>

                    <x-forms.input
                        wire:model="npwp"
                        title="NPWP"
                        required/>

                    <x-forms.input
                        wire:model="an_name_of"
                        title="Atas Nama"
                        required/>
                </div>

                <x-forms.button-submit/>

            </div> --}}
        </div>
    </div>
</div>
