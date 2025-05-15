<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />

        <x-forms.button-add-new @click="$dispatch('open-modal')" />
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <livewire:tables.categories-table />
    </div>

    {{-- Form Modal --}}
    <x-partials.modal
        class="max-w-xl"
        :head-name="($model_id ? __('Edit') : __('Tambah')) . ' ' . Str::singular($meta_title)"
    >
        <div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5">
            <form>
                <div class="mt-4 space-y-4">
                    {{-- Basic Info Section --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <x-forms.input wire:model="name" title="Nama" required />

                        <x-forms.select-box
                            wire:model="type"
                            title="Tipe"
                            :options="$typeList"
                            basic
                            required
                            placeholder="Pilih tipe" />

                    </div>

                    <x-forms.button-submit/>
                </div>
            </form>
        </div>
    </x-partials.modal>

    {{-- Utility Modals --}}
    <x-partials.confirm type="delete" />
</main>
