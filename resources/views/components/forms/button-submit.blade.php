<div class="space-x-2 text-right">
    <button type="button" @click="{{ $modalKey ?? 'showModal' }} = false" class="btn mt-6 h-8 text-xs+ font-medium text-slate-700 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25">
        Batal
    </button>
    <button
        type="button"
        {{-- wire:loading.remove --}}
        wire:click="{{ $wireClick ?? 'store' }}"
        class="btn h-8 mt-6 bg-primary text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
            Simpan
    </button>

    <div wire:loading wire:target="{{ $wireClick ?? 'store' }}" style="text-align: -webkit-center;">
        <div class="spinner h-7 w-7 animate-spin rounded-full border-[3px] border-primary/30 border-r-primary dark:border-accent/30 dark:border-r-accent">
        </div>
    </div>
</div>
