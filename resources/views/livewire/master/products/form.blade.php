<x-partials.modal
    class="max-w-xl"
    :head-name="($model_id ? __('Edit') : __('Tambah')) . ' ' . Str::singular($meta_title)"
>
    <div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5">
        <form>
            <div class="mt-4 space-y-4">
                {{-- Basic Info Section --}}
                <x-forms.input wire:model="name" title="Nama" required />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                    <x-forms.select-box wire:model="merk_id" title="Merk" :options="$merkList" required placeholder="Pilih merk" />

                    <x-forms.input wire:model="type" title="Tipe" required />

                    <x-forms.select-box wire:model="unit_id" title="Unit" :options="$unitList" required placeholder="Pilih unit" />

                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <x-forms.input
                        wire:model.blur="hpp"
                        placeholder=""
                        title="HPP"
                        addon="Rp."
                        class="text-right"
                        x-data
                        x-init="new Cleave($el, { numeral: true })"
                        required />

                    <x-forms.input
                        wire:model="price"
                        placeholder=""
                        title="Harga + Persentase"
                        addon="Rp."
                        class="text-right"
                        readonly
                        x-data
                        x-init="new Cleave($el, { numeral: true })"
                        required />

                </div>

                <div class="flex justify-between space-x-2 text-error">
                    <p class="line-clamp-1">HPP &#8804; 1jt + 10%</p>
                    <p class="line-clamp-1">HPP > 1jt s/d &#8804; 2jt + 7.5%</p>
                    <p class="line-clamp-1">HPP > 2jt + 5%</p>
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
