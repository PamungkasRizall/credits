<div class="card mt-3">
    <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
        <div class="flex items-center space-x-2">
            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                <i class="fa-solid fa-code-fork"></i>
            </div>
            <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                Kerangka Detail
            </h4>
        </div>
    </div>
    <div class="space-y-4 p-4 sm:p-5">

        <div class="grid grid-cols-2 gap-4">

            <x-forms.select-box
                wire:model="method_id"
                title="Metode {{ $type_desc }}"
                :options="collect($trainingMethods)"
                required />

            <x-forms.select-box
                wire:model="mechanism_id"
                title="Mekanisme {{ $type_desc }}"
                :options="collect($mechanisms)"
                required />

        </div>

        <x-forms.select-box
            wire:model="levels"
            title="Level"
            multiple
            :options="collect($listLevels)"
            required />

        <x-forms.select-box
            wire:model="categories"
            title="Kategori"
            multiple
            :options="collect($listCategories)"
            required />

        <div class="grid grid-cols-2 gap-4">

            <x-forms.select-box
                wire:model="scope_id"
                title="Cakupan {{ $type_desc }}"
                :options="collect($scopes)"
                required />

            <x-forms.input
                wire:model="quota"
                placeholder=""
                title="Kuota Peserta"
                x-data
                x-init="new Cleave($el, { numeral: true })"
                class="text-right"
                svgd="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                />

        </div>

        <div class="grid grid-cols-2 gap-4">

            <x-forms.radio-button
                wire:model.live="is_paid"
                title="Pembayaran"
                :options="collect($paids)"
                required />

            @if ($is_paid)
            <x-forms.input
                wire:model="price"
                title="Price"
                addon="Rp."
                class="text-right"
                x-data
                x-init="new Cleave($el, { numeral: true })"
                required />
            @endif

        </div>

        <div class="grid grid-cols-2 gap-4">
            <x-forms.flatpickr
                wire:model="start_at"
                title="Tgl Awal Pelaksanaan"
                :options="collect(['enableTime' => true, 'dateFormat' => 'Y-m-d H:i', 'minDate' => $minDate])"
                required
            />

            <x-forms.flatpickr
                wire:model="end_at"
                title="Tgl Akhir Pelaksanaan"
                :options="collect(['enableTime' => true, 'dateFormat' => 'Y-m-d H:i', 'minDate' => $minDate])"
                required
            />

        </div>

        <div>
            <span>No Kontak Penyedia <span class="text-tiny+ text-error">*</span></span>

            @foreach ($contactPersons as $index => $contactPerson)
                @php
                    $modelName = "contactPersons.$index.name";
                    $modelPhone = "contactPersons.$index.phone";
                @endphp
            <div class="mt-1.5 flex -space-x-px" wire:key="contact-{{ $index }}">
                <input
                    class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Nama"
                    wire:model="contactPersons.{{ $index }}.name"
                    type="text" />

                <div class="flex items-center justify-center border border-slate-300 bg-slate-150 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100">
                    <span class="mt-1">
                        @if ($index > 0)
                        <button wire:click="removeContactPerson({{ $index }})" x-tooltip.placement.left="'Hapus Data'" class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                        @else
                        <button wire:click="addContactPerson" x-tooltip.placement.left="'Tambah Data'" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-px h-5.5 w-5.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                        @endif

                    </span>
                </div>

                <input
                    wire:model="contactPersons.{{ $index }}.phone"
                    class="form-input w-full rounded-r-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="No Whatsapp"
                    x-input-mask="{
                        numericOnly: true,
                        blocks: [4, 3, 3, 4],
                        delimiters: ['-']
                    }"
                    required
                    type="text" />

            </div>
            @error($modelName) <p class="text-tiny+ text-error">{{ $message }}</p> @enderror
            @error($modelPhone) <p class="text-tiny+ text-error">{{ $message }}</p> @enderror
            @endforeach

        </div>

    </div>
</div>
