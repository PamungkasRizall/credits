<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />

        <x-forms.button-add-new @click="$dispatch('open-modal')" />
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <livewire:tables.courses-table />
    </div>

    {{-- Form Modal --}}
    <x-partials.modal
        class="max-w-6xl"
        :head-name="($model_id ? __('Edit') : __('Add')) . ' ' . Str::singular($meta_title)"
    >
        <div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5">
            <form>
                <div class="mt-4 space-y-4">
                    {{-- Basic Info Section --}}
                    <x-forms.input wire:model="title" title="Title" required />

                    {{-- Course Details Grid --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                        <x-forms.input
                            wire:model="wa_cs"
                            title="Whatsapp CS"
                            labelClass="sm:col-span-3"
                            placeholder="628-999-999-99"
                            x-input-mask="{
                                numericOnly: true,
                                blocks: [4, 3, 3, 4],
                                delimiters: ['-']
                            }"
                            required
                        />

                        <x-forms.select-box
                            wire:model="category_id"
                            title="Category"
                            labelClass="sm:col-span-3"
                            :options="collect($categories)"
                            basic
                            required
                        />

                        <x-forms.input
                            wire:model="price"
                            title="Price"
                            addon="Rp."
                            class="text-right"
                            labelClass="sm:col-span-3"
                            x-data
                            x-init="new Cleave($el, { numeral: true })"
                            required
                        />

                        <x-forms.input
                            wire:model="link_lms"
                            placeholder="https://lms.kemkes.go.id"
                            title="Link LMS"
                            labelClass="sm:col-span-3"
                            svgd="'M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244'"
                        />
                    </div>

                    {{-- Description & Image Section --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <x-forms.text-editor
                            wire:model="description"
                            title="Description"
                            index="0"
                        />

                        <label class="block">
                            <span>
                                Poster Image @if (!$model_id)<span class="text-tiny+ text-error">*</span>@endif
                            </span>
                            <span class="relative flex -space-x-px">
                                <x-forms.filepond
                                    wire:model="file"
                                    labelClass="mt-0"
                                    multiple
                                    allowImagePreview
                                    {{-- imagePreviewMaxHeight="200" --}}
                                    allowFileTypeValidation
                                    acceptedFileTypes="['image/png', 'image/jpg']"
                                    allowFileSizeValidation
                                    maxFileSize="4mb"
                                />
                            </span>
                            @error('file') <span class="text-tiny+ text-error">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <x-forms.button-submit/>
                </div>
            </form>
        </div>
    </x-partials.modal>

    {{-- Utility Modals --}}
    <x-partials.confirm type="delete" />
    <x-partials.image-preview-modal :src="$showImageUrl" />
</main>
