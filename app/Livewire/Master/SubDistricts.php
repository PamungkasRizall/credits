<?php

namespace App\Livewire\Master;

use Livewire\Component;

class SubDistricts extends Component
{
    public string $meta_title = '';

    public function mount()
    {
        $this->authorize('subdistricts');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Wilayah';
    }

    public function render()
    {
        return view('livewire.master.sub-districts')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }
}
