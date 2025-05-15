
<div class="card p-4 sm:p-5" style="margin-bottom: 1.5rem;">
    <p class="text-base font-medium text-slate-700 dark:text-navy-100">
        Kerangka Utama
    </p>
    <div class="mt-4 space-y-4">

        <x-forms.input
            wire:model="title"
            placeholder=""
            title="Judul"
            required />

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <x-forms.select-box
                wire:model="type_id"
                title="Jenis Pembelajaran"
                :options="collect($types)"
                required />

            <x-forms.select-box
                wire:model="level_id"
                title="Level"
                :options="collect($levels)"
                required />

            <x-forms.select-box
                wire:model="category_id"
                title="Kategori"
                :options="collect($categories)"
                required />

        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <x-forms.select-box
                wire:model="method_id"
                title="Metode"
                :options="collect($trainingMethods)"
                required />

            <x-forms.select-box
                wire:model="mechanism_id"
                title="Mekanisme"
                :options="collect($mechanisms)"
                required />

            {{-- <x-forms.radio-button
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
            @endif --}}

        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <x-forms.flatpickr
                wire:model="start_at"
                title="Tgl Awal Pelaksanaan"
                :options="collect(['enableTime' => true, 'dateFormat' => 'Y-m-d H:i'])"
                required
            />

            <x-forms.flatpickr
                wire:model="end_at"
                title="Tgl Akhir Pelaksanaan"
                :options="collect(['enableTime' => true, 'dateFormat' => 'Y-m-d H:i'])"
                required
            />

            <x-forms.input
                wire:model="quota"
                placeholder=""
                title="Kuota Peserta"
                x-data
                x-init="new Cleave($el, { numeral: true })"
                class="text-right"
                svgd="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                required />
        </div>

        <x-forms.text-editor
            wire:model="description"
            value="{!! $description !!}"
            title="Deskripsi"
            labelClass="mt-5"
            index=0
            required
        />

        <x-forms.input-tag
            wire:model="targetParticipants"
            title="Target Peserta"
            placeholder="Masukkan Kata"
            required />

        <x-forms.text-editor
            wire:model="goal"
            value="{!! $goal !!}"
            title="Tujuan"
            labelClass="mt-5"
            index=0
            required
        />

        <x-forms.text-editor
            wire:model="competence"
            value="{!! $competence !!}"
            title="Kompetensi"
            labelClass="mt-5"
            index=0
            required
        />

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

                <div class="flex items-center justify-center border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100">
                    <span class="mt-1">
                        @if ($index > 0)
                        <button wire:click="removeContactPerson({{ $index }})" x-tooltip.placement.left="'Hapus Data'" class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                        @else
                        <button wire:click="addContactPerson" x-tooltip.placement.left="'Tambah Data'" class="btn h-9 w-9 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
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

        <x-forms.input
            wire:model="file"
            type="file"
            title="Poster"
            svgd="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
            required />

        {{-- <label class="block">
            <span>
                Poster Image @if (!$model_id)<span class="text-tiny+ text-error">*</span>@endif
            </span>
            <span class="relative flex -space-x-px">
                <x-forms.filepond
                    wire:model="file"
                    labelClass="mt-0"
                    multiple
                    allowImagePreview
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg']"
                    allowFileSizeValidation
                    maxFileSize="4mb"
                />
            </span>
            @error('file') <span class="text-tiny+ text-error">{{ $message }}</span> @enderror
        </label> --}}

    </div>
</div>
