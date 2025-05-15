<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />

        @can ('consumers-create')
            {{-- <x-forms.button-add-new @click="$dispatch('open-modal')" /> --}}
        @endcan

    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <livewire:tables.consumers-table>
    </div>

    {{-- Form Modal --}}
    <x-partials.modal class="max-w-3xl" :head-name="($model_id ? 'Edit' : 'Tambah') .' '. Str::singular($meta_title)">

        @include('livewire.master.consumers.form')

    </x-partials.modal>

    <x-partials.modal class="max-w-xl" head-name="Form Upload File Complete" modal-key="form-upload">

        <div class="card sm:order-last sm:col-span-2 lg:order-none lg:col-span-1 mt-4">
            <div class="space-y-4 py-3 px-4 sm:px-5">

                <x-forms.filepond
                    wire:model="file"
                    allowFileTypeValidation
                    acceptedFileTypes="['application/pdf']"
                    allowFileSizeValidation
                    required
                    maxFileSize="2mb" />

                @error('file') <span class="text-error py-5">{{ $message }}</span> @enderror

                <div class="flex items-center justify-between">
                    <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">

                    </h2>

                    {{-- Button --}}
                    <x-forms.button-submit wire-click="storeFileUpload"/>
                </div>
            </div>
        </div>

    </x-partials.modal>

    <x-partials.confirm type="delete" />
</main>
