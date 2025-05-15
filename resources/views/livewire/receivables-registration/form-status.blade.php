<div class="card sm:order-last sm:col-span-2 lg:order-none lg:col-span-1 mt-4">
    <div class="space-y-4 py-3 px-4 sm:px-5">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <x-forms.select-box
                wire:model.live="status"
                title="Status"
                :options="$statuses"
                basic
                disablePlaceholder
                required />

            <x-forms.flatpickr
                wire:model.live="date_at_installment"
                title="Tanggal"
                :options="collect(['dateFormat' => 'Y-m-d', 'enableTime' => false, 'altFormat' =>  'j M Y'])"
                required />
        </div>

        <label class="block">
            <span>AWD <span class="text-tiny+ text-error">*</span></span>
            <div class="mt-5 grid grid-cols-2 place-items-start gap-6 sm:grid-cols-4">
                <x-forms.check-box model="awd" :options="$awdList" />
            </div>
            @error('awd')
              <span class="text-tiny+ text-error">{{ $message }}</span>
            @enderror
        </label>

        <div class="flex items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                Form Kirim Barang
            </h2>
            {{-- Button --}}
            <x-forms.button-submit wire-click="storeStatus"/>
        </div>
    </div>
</div>
