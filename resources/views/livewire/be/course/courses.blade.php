<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
      <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
        Courses
      </h2>
      <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
      </div>
      <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li>Create</li>
      </ul>
    </div>

    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        <div class="col-span-12 grid lg:col-span-7">

            @include('livewire.be.course.partials.basic-info')

            {{-- @include('livewire.be.course.partials.content') --}}

        </div>

        <div class="col-span-12 lg:col-span-5">
            <div class="card space-y-5 p-4 sm:p-5">
                <div class="mt-4 flex items-center">
                    <label class="inline-flex items-center space-x-2">
                        <input
                            class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                            type="checkbox"
                            wire:model='is_draft'
                            value="1">
                        <span class="line-clamp-1">Simpan Sebagai Draft</span>
                    </label>
                </div>

                <button
                    wire:click="store"
                    class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                >
                    <span>SIMPAN</span>
                </button>
            </div>

            @include('livewire.be.course.partials.detail-info')

            @include('livewire.be.course.partials.target-participants')

        </div>
    </div>
</main>


{{-- <main class="main-content w-full px-[var(--margin-x)] pb-8">
    Header Section
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />

        <x-forms.button-add-new wire:click="create" />
    </div>

    Main Content
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <livewire:tables.courses-table />
    </div>

    Utility Modals
    <x-partials.confirm type="delete" />
    <x-partials.image-preview-modal :src="$showImageUrl" />
</main> --}}
