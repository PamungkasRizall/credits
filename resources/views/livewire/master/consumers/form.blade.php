<div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5">
    <form>
        {{-- Form --}}
        <div class="space-y-4">
            
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                <x-forms.input
                    wire:model="name"
                    placeholder=""
                    title="Nama"
                    labelClass="sm:col-span-8"
                    required />

                <x-forms.input
                    wire:model="nik"
                    placeholder=""
                    title="NIK"
                    maxlength="16"
                    labelClass="sm:col-span-4"
                    required />
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                <x-forms.radio-button
                    wire:model="gender"
                    title="Jenis Kelamin"
                    :options="$genders"
                    required />

                <x-forms.flatpickr
                    wire:model="date_of_birth"
                    title="Tgl Lahir"
                    :options="collect(['dateFormat' => 'Y-m-d', 'enableTime' => false, 'altFormat' =>  'j F Y'])"
                    required />

                <x-forms.input
                    wire:model="phone"
                    placeholder="628..."
                    title="No HP"
                    maxlength="15"
                    x-data
                    x-init="new Cleave($el, { numeral: true, delimiter: '' })"
                    required />

                <x-forms.input
                    wire:model="radius"
                    placeholder="0.5"
                    title="Radius"
                    addon="km"
                    class="text-right"
                    x-data
                    x-init="new Cleave($el, { numeral: true, delimiter: '' })"
                    required />
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <x-forms.select-box
                    wire:model.live="city_code"
                    :options="$cities"
                    title="Kab / Kota"
                    required
                     />

                <x-forms.select-box
                    wire:model.live="district_code"
                    :options="$districts"
                    title="Kecamatan"
                    required
                    basic />

                <x-forms.select-box
                    wire:model.live="sub_district_code"
                    :options="$subDistricts"
                    title="Desa / Kelurahan"
                    required
                    basic />

            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                <x-forms.input
                    wire:model="home_address"
                    placeholder=""
                    title="Alamat Rumah"
                    labelClass="sm:col-span-8"
                    required />

                <x-forms.input
                    wire:model="business_type"
                    placeholder=""
                    title="Jenis Usaha"
                    labelClass="sm:col-span-4"
                    required />
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                <x-forms.input
                    wire:model="business_address"
                    placeholder=""
                    title="Alamat usaha"
                    labelClass="sm:col-span-8"
                    required />

                <x-forms.input
                    wire:model="business_status"
                    placeholder=""
                    title="Status Usaha"
                    labelClass="sm:col-span-4"
                    required />
            </div>

            <div class="my-3 flex items-center space-x-3">
                <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
                <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">Pendamping</h2>
                <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                <x-forms.input
                    wire:model="companion.name"
                    placeholder=""
                    title="Nama"
                    labelClass="sm:col-span-8"
                    required />

                <x-forms.input
                    wire:model="companion.phone"
                    placeholder="628..."
                    title="No HP"
                    maxlength="15"
                    labelClass="sm:col-span-4"
                    x-data
                    x-init="new Cleave($el, { numeral: true, delimiter: '' })"
                    required />
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <x-forms.input
                    wire:model="companion.address"
                    placeholder=""
                    title="Alamat"
                    required />

                <x-forms.input
                    wire:model="companion.profession"
                    placeholder=""
                    title="Profesi"
                    required />

                <x-forms.select-box
                    wire:model="companion.relationship_id"
                    title="Hubungan"
                    :options="$relationships"
                    basic
                    required />
            </div>

            <x-forms.button-submit/>
        </div>
    </form>
</div>
