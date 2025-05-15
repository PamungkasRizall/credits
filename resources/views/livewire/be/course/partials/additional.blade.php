<div class="card p-4 sm:p-5" style="margin-bottom: 1.5rem;">
    <p class="text-base font-medium text-slate-700 dark:text-navy-100">
        Keuntungan & Pengumuman
    </p>
    <div class="mt-4 space-y-4">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <x-forms.input
                wire:model="additionals.jpl"
                placeholder=""
                title="JPL"
                x-init="new Cleave($el, { numeral: true })"
                class="text-right"
                svgd="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12"
                required />

            <x-forms.input
                wire:model="additionals.skp"
                placeholder=""
                title="Satuan Kredit Profesi (SKP)"
                x-init="new Cleave($el, { numeral: true })"
                class="text-right"
                svgd="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12"
                required />

            <x-forms.input
                wire:model="additionals.video_minutes"
                placeholder=""
                title="Total Menit Video Pembelajaran"
                x-init="new Cleave($el, { numeral: true })"
                class="text-right"
                svgd="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"
                required />

        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <x-forms.input
                wire:model="additionals.reading_material"
                placeholder=""
                title="Bahan Bacaan"
                x-init="new Cleave($el, { numeral: true })"
                class="text-right"
                svgd="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                required />

            <x-forms.input
                wire:model="additionals.content_downloaded"
                placeholder=""
                title="Konten Dapat Diunduh"
                x-init="new Cleave($el, { numeral: true })"
                class="text-right"
                svgd="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"
                required />

            <x-forms.radio-button
                wire:model.live="additionals.certificate"
                title="Sertifikat"
                :options="collect($certificates)"
                required />

        </div>

        <x-forms.text-editor
            wire:model="additionals.notes"
            value="{!! $additionals['notes'] ?? '' !!}"
            title="Pengumuman"
            labelClass="mt-5"
            index=0 />

        <x-forms.input
            wire:model="link_lms"
            placeholder="https://lms.kemkes.go.id"
            title="Link LMS"
            svgd="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"
        />

    </div>
</div>
