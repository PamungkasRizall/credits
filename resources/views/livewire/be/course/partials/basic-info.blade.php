<div class="card">
    <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
        <div class="flex items-center space-x-2">
            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                Kerangka Utama
            </h4>
        </div>
    </div>
    <div class="space-y-4 p-4 sm:p-5">

        <x-forms.radio-button
            wire:model.live="type_id"
            title="Jenis Pembelajaran"
            :options="collect($types)"
            item-bold
            required />

        <x-forms.textarea
            wire:model="title"
            rows="2"
            title="Judul {{ $type_desc }}"
            required />

        <x-forms.text-editor
            wire:model="description"
            value="{!! $description !!}"
            title="Deskripsi"
            labelClass="mt-5"
            index=0
            required
        />

        <x-forms.text-editor
            wire:model="goal"
            value="{!! $goal !!}"
            title="Tujuan"
            labelClass="mt-5"
            index=1
            required
        />

        <x-forms.text-editor
            wire:model="competence"
            value="{!! $competence !!}"
            title="Kompetensi"
            labelClass="mt-5"
            index=2
            required
        />

        <x-forms.input
            wire:model="file"
            type="file"
            title="Poster {{ $type_desc }}"
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

        <x-forms.input
            wire:model="additionals.link_file"
            placeholder="https://drive.google.com"
            title="Link Berkas Pendukung"
            required
            svgd="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"
        />

        <x-forms.text-editor
            wire:model="additionals.notes"
            {{-- value="{!! $additionals['notes'] ?? '' !!}" --}}
            title="Pengumuman"
            labelClass="mt-5"
            index=3 />
    </div>
</div>
