<div class="rounded-lg bg-info/10 px-4 pb-5 dark:bg-navy-800 sm:p-5 my-4">
    <div class="flex items-center pb-3">
        <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
            Konsumen
        </h2>
    </div>
    <div class="space-y-4">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    {{ $consumer->name }}
                </h3>
                <p class="text-xs text-slate-400 dark:text-navy-300">
                    {{ $consumer->nik }}
                </p>
            </div>
            <div>
                <h3 class="text-lg text-right font-medium text-slate-700 dark:text-navy-100">
                    {{ $consumer->date_of_birth->age }} tahun
                </h3>
                <p class="text-xs text-slate-400 dark:text-navy-300 text-right">
                    {{ $consumer->date_of_birth->format('d/m/Y') }}
                </p>
            </div>
        </div>
        <div class="space-y-3 text-xs+">
            <div class="flex justify-between">
                <p class="text-right">No HP</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    <a class="text-primary" href="https://api.whatsapp.com/send?phone={{ $consumer->phone }}&text=" target="_blank">+{{ $consumer->phone }}</a>
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Radius</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $consumer->radius }} km
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Alamat</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $consumer->home_address }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Jenis Usaha</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $consumer->business_type }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Status Usaha</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $consumer->business_status }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Alamat Usaha</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $consumer->business_address }}
                </p>
            </div>
        </div>
    </div>
</div>
