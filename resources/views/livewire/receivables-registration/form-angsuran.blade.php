<div class="card sm:order-last sm:col-span-2 lg:order-none lg:col-span-1 mt-4">
    <div class="space-y-4 py-3 px-4 sm:px-5">

        <label class="block">
            <span>Angsuran <span class="text-tiny+ text-error">*</span></span>
            <div class="mt-5 grid grid-cols-2 place-items-start gap-6 sm:grid-cols-4">
                @foreach($angsuranList as $k => $val)
                    <label class="inline-flex items-center space-x-2">
                        <input
                            class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-primary-light dark:checked:border-primary-light dark:hover:border-primary-light dark:focus:border-primary-light"
                            type="checkbox"
                            value="{{ $val->number }}"
                            @if ($val->updated_at)
                                checked
                                disabled
                            @else
                                wire:model="angsuran.{{ $k }}"
                            @endif
                        />
                        <p class="{{ $val->updated_at ? 'text-success' : '' }}">{{ $val->date_at->format('d/m/Y') }}</p>
                    </label>
                @endforeach
            </div>
            @error('angsuran')
              <span class="text-tiny+ text-error">{{ $message }}</span>
            @enderror
        </label>

        <div class="flex items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                Form Angsuran
            </h2>
            {{-- Button --}}
            <x-forms.button-submit wire-click="storeAngsuran"/>
        </div>
    </div>
</div>
