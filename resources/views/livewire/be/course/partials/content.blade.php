
<div class="card mt-3">
    <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
        <div class="flex items-center space-x-2">
            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                <i class="fa-solid fa-book"></i>
            </div>
            <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                Modul
            </h4>
        </div>
    </div>

    @foreach ($contents as $contentIndex => $content)
    <div class="card p-4 sm:p-5" style="margin-bottom: 1.5rem;" wire:key="content-{{ $contentIndex }}">
        <div class="flex items-center justify-between">
            <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                Konten ({{ $contentIndex + 1 }})
            </p>

            @if ($contentIndex > 0)
                <button wire:click="removeContent({{ $contentIndex }})" class="border-b border-dotted border-current pb-0.5 text-xs+ font-medium text-error outline-none transition-colors duration-300 hover:text-error/70 focus:text-error/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70">
                    Hapus Konten
                </button>
            @else
                <button wire:click="addContent" class="border-b border-dotted border-current pb-0.5 text-xs+ font-medium text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70">
                    Tambah Konten
                </button>
            @endif
        </div>

        <div class="mt-4 space-y-4">

            <x-forms.input
                wire:model="contents.{{ $contentIndex }}.title"
                title="Judul"
                required />

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                <x-forms.input
                    wire:model="contents.{{ $contentIndex }}.performer"
                    title="Pengisi Acara" />

                <x-forms.input
                    wire:model="contents.{{ $contentIndex }}.location"
                    title="Lokasi" />

            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <x-forms.select-box
                    wire:model="contents.{{ $contentIndex }}.method_id"
                    title="Format Studi"
                    :options="collect($trainingMethods)" />

                <x-forms.flatpickr
                    wire:model="contents.{{ $contentIndex }}.start_at"
                    title="Tgl Awal Konten"
                    :options="collect(['enableTime' => true])" />

                <x-forms.flatpickr
                    wire:model="contents.{{ $contentIndex }}.end_at"
                    title="Tgl Akhir Konten"
                    :options="collect(['enableTime' => true])" />

            </div>
        </div>

        <p class="text-base font-medium pt-10 text-slate-700 dark:text-navy-100">
            Modul
        </p>

        @foreach ($content['modules'] as $moduleIndex => $module)
            @php
                $modelTitle = "contents.$contentIndex.modules.$moduleIndex.title";
                $modelMinutes = "contents.$contentIndex.modules.$moduleIndex.minutes";
            @endphp
        <div class="mt-4 space-y-4" wire:key="module-{{ $moduleIndex }}">

            <div class="flex items-center justify-between">
                <p>
                    Judul <span class="text-tiny+ text-error">*</span>
                </p>
                <p>
                    Menit <span class="text-tiny+ text-error">*</span>
                </p>
            </div>
            <div class="flex -space-x-px" style="margin-top: 0.375rem;">
                <input
                    wire:model="{{ $modelTitle }}"
                    class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    type="text" />
                <div
                class="flex items-center justify-center border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100"
                >
                    @if ($moduleIndex > 0)
                    <button wire:click="removeContentModule({{ $contentIndex }},{{ $moduleIndex }})" x-tooltip.placement.left="'Hapus Data'" class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                    @else
                    <button wire:click="addContentModule({{ $contentIndex }})" x-tooltip.placement.left="'Tambah Data'" class="btn h-9 w-9 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-px h-5.5 w-5.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </button>
                    @endif
                </div>
                <input
                    wire:model="{{ $modelMinutes }}"
                    class="form-input w-2/12 rounded-r-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    x-data
                    x-init="new Cleave($el, { numeral: true })"
                    type="text" />
            </div>
            @error($modelTitle) <p class="text-tiny+ text-error">{{ $message }}</p> @enderror
            @error($modelMinutes) <p class="text-tiny+ text-error">{{ $message }}</p> @enderror
        </div>
        @endforeach
    </div>
    @endforeach

</div>
