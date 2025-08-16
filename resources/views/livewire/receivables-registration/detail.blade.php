<div class="rounded-lg bg-info/10 px-4 pb-5 dark:bg-navy-800 sm:p-5 my-4">
    <div class="flex items-center pb-3 justify-between">
        <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
            Faktur Baru
        </h2>
        <span class="border-b border-dotted border-current pb-0.5 text-xs+ font-medium text-primary">
            {{ $receivablesRegistration->reg_code }}
        </span>
    </div>
    <div class="space-y-4">
        <div class="flex justify-between">
            <div>
                <p class="text-xs text-slate-400 dark:text-navy-300">
                    Angsuran Per Hari
                </p>
                <h3 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    Rp {{ currency($receivablesRegistration->bill_per_day) }}
                </h3>
            </div>
            <div>
                <p class="text-xs text-slate-400 dark:text-navy-300 text-right">
                    Tenor
                </p>
                <h3 class="text-lg text-right font-medium text-slate-700 dark:text-navy-100">
                    {{ $receivablesRegistration->tenor }} hari
                </h3>
            </div>
        </div>
        <div class="space-y-3 text-xs+">
            <div class="flex justify-between">
                <p class="text-right">Status</p>
                @php
                    $status = $receivablesRegistration->status;
                    $color = $status->coloringClasses();
                @endphp


                <div class="badge bg-{{ $color }}/10 text-{{ $color }} dark:bg-{{ $color }}/15">
                    {{ $status->naming() }}
                </div>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Tanggal</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $receivablesRegistration->date_at->format('d/m/Y') }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Sales</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $receivablesRegistration->sales->name }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Supervisor</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $receivablesRegistration->supervisor->name }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Wasdit</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $receivablesRegistration->wasdit->name }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">AR</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $receivablesRegistration->ar->name }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Koletor</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $receivablesRegistration->collector->name }}
                </p>
            </div>
        </div>
    </div>
</div>
