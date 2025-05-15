<div class="card mt-3">
    <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
        <div class="flex items-center space-x-2">
            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                <i class="fa-solid fa-users"></i>
            </div>
            <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                Sasaran Peserta
            </h4>
        </div>
    </div>
    <div class="space-y-4 p-4 sm:p-5">

        <x-forms.select-box
            wire:model="professions"
            title="Profesi Nakes / Lainnya"
            multiple
            :options="collect($listProfessions)"
            required />

        <label class="block">
            <span>
                Jenis Pengguna <span class="text-tiny+ text-error">*</span>
            </span>
            <div class="mt-5 grid grid-cols-1 place-items-start gap-2 sm:grid-cols-1">

                <x-forms.check-box
                    model="studentTypes"
                    :options="$listStudentTypes" />
            </div>
            @error('studentTypes')
                <span class="text-tiny+ text-error">{{ $message }}</span>
            @enderror
        </label>

    </div>
</div>
