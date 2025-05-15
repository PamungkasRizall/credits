<x-partials.modal
    class="max-w-xl"
    :head-name="($model_id ? __('Edit') : __('Tambah')) . ' ' . Str::singular($meta_title)"
>
    <div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5">
        <form>
            <div class="mt-4 space-y-4">
                {{-- Basic Info Section --}}
                <x-forms.input wire:model="name" title="Nama" required />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <x-forms.select-box wire:model="merk_id" title="Merk" :options="$merkList" required placeholder="Pilih merk" />

                    <x-forms.input wire:model="type" title="Tipe" required />

                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <x-forms.select-box wire:model="unit_id" title="Unit" :options="$unitList" required placeholder="Pilih unit" />

                    <x-forms.input
                        wire:model="price"
                        placeholder=""
                        title="HPP"
                        addon="Rp."
                        class="text-right"
                        x-data
                        x-init="new Cleave($el, { numeral: true })"
                        required />

                </div>

                <x-forms.text-editor
                    wire:model="notes"
                    value="{!! $notes !!}"
                    title="Deskripsi"
                    minHeight="h-40"
                    labelClass="mt-2"
                />

                <x-forms.button-submit/>
            </div>
        </form>
    </div>
</x-partials.modal>
