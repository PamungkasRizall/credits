<div class="rounded-lg bg-info/10 px-4 pb-5 dark:bg-navy-800 sm:p-5 my-4">
    <div class="flex items-center pb-3">
        <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
            Produk
        </h2>
    </div>
    <div class="space-y-4">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    {{ $product->name }}
                </h3>
            </div>
            <div>
                <h3 class="text-lg text-right font-medium text-slate-700 dark:text-navy-100">
                    Rp {{ currency($product->price) }}
                </h3>
                {{-- <p class="text-xs text-slate-400 dark:text-navy-300 text-right">
                    {{ currency($product->price) }}
                </p> --}}
            </div>
        </div>
        <div class="space-y-3 text-xs+">
            <div class="flex justify-between">
                <p class="text-right">Tipe</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $product->type }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Merk</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $product->merk->name }}
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-right">Unit</p>
                <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $product->unit->name }}
                </p>
            </div>
        </div>
    </div>
</div>
