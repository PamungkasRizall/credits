<div class="card space-y-4 p-2 sm:p-3">
    <x-forms.input
        wire:model="consumerDesc"
        title="Konsumen"
        wire:click="showModalConsumer"
        class="bg-transparent"
        required
        readonly
        svgd="M14.25 9.75 16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />

    <x-forms.input
        wire:model="productDesc"
        title="Produk"
        wire:click="showModalProduct"
        class="bg-transparent"
        required
        readonly
        svgd="M14.25 9.75 16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <x-forms.input
            wire:model="down_payment"
            placeholder="Rp ..."
            title="DP"
            class="text-right"
            x-data
            x-init="new Cleave($el, { numeral: true })"
            required />

        <x-forms.input
            wire:model.live="bill_per_day"
            placeholder="Rp ..."
            title="Angsuran per Hari"
            class="text-right"
            x-data
            x-init="new Cleave($el, { numeral: true })"
            required />

        <x-forms.flatpickr
            wire:model="date_at"
            title="Tanggal"
            :options="collect(['dateFormat' => 'Y-m-d', 'enableTime' => false, 'altFormat' =>  'j F Y'])"
            required />
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-12" wire:ignore>

        <x-forms.select-box
            wire:model.live="tenor"
            title="Tenor"
            :options="$tenors"
            labelClass="sm:col-span-3"
            basic
            required
            sameValue />

        <x-forms.input
            wire:model="total"
            placeholder="Rp ..."
            title="Total"
            class="text-right"
            labelClass="sm:col-span-3"
            x-data
            readonly
            required
            x-init="new Cleave($el, { numeral: true })" />

        <x-forms.select-box
            wire:model="sales_id"
            title="Mitra Bisnis"
            autocomplete="user"
            labelClass="sm:col-span-6"
            required />
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" wire:ignore>

        <x-forms.select-box
            wire:model="supervisor_id"
            title="Supervisor"
            autocomplete="user"
            required />

        <x-forms.select-box
            wire:model="wasdit_id"
            title="Wasdit"
            autocomplete="user"
            required />
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" wire:ignore>

        <x-forms.select-box
            wire:model="ar_id"
            title="AR"
            autocomplete="user"
            required />

        <x-forms.select-box
            wire:model="collector_id"
            title="Kolektor"
            autocomplete="user"
            required />

    </div>

    <x-forms.button-submit/>

</div>
